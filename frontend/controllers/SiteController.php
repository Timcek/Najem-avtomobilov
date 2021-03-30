<?php
namespace frontend\controllers;

use frontend\models\Cars;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\car_info;
use frontend\models\Add_new_car;
use yii\helpers\ArrayHelper as HelpersArrayHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout ="index";
        $model = new Cars();
        return $this->render('index',['model' => $model]);
    }

    public function actionDisplay_cars(){
        $model = new Cars();
        $this->layout="display_cars_layout";
        if($model->load(Yii::$app->request->post())){
            //to dodamo v session zato, da lahko pridemo nazaj iz car_info (drugače nas pošlje nazaj na Home)
            $_SESSION["Cars"]=HelpersArrayHelper::toArray($model);
            //ta redirect je zato, da se lahko vrnemo iz car_info(v prvič), ker drugače nam vrne "ali želite ponovno poslati obrazec"
            return $this->redirect(["site/display_cars"]);
        }elseif(isset($_SESSION["Cars"])){
            //dodamo informacije(ki smo jih predhodno shranili v session) v model, ki ga nato podamo render metodi 
            $model->car_company=$_SESSION["Cars"]["car_company"];
            $model->model=$_SESSION["Cars"]["model"];
            $model->year=$_SESSION["Cars"]["year"];
            $model->price=$_SESSION["Cars"]["price"];
            if(isset($_SESSION["Cars"]["dors"])){
                $model->gearing_type=$_SESSION["Cars"]["gearing_type"];
                $model->dors=$_SESSION["Cars"]["dors"];
                $model->seats=$_SESSION["Cars"]["seats"];
                $model->fuel_type=$_SESSION["Cars"]["fuel_type"];
                $model->engine_power=$_SESSION["Cars"]["engine_power"];
            }
            return $this->render('display_cars',['model' => $model]);
        }
        return $this->render("display_cars",["model"=>$model]);
    }
    

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionAdd_cars(){
        $model = new Add_new_car();

        //ce smo pritisnili Crop and Save mora biti v getu photo: true (settamo jo v URL-ju)
        if(isset($_GET["photo"])){
            //Ko izberemo ali spremenimo sliko pridemo sem notri (zaradi photo)
            $model->setSessionItems();

            //da dobimo ime slike, ki je shranjena v $_FILES
            $croppedImage = $_FILES["cropped_image"];
            $to_be_upload = $croppedImage["tmp_name"];

            $randomString = $model->generateRandomString();
            $model->savingToTemporary($to_be_upload,$randomString);
        }elseif($model->load(Yii::$app->request->post())){
            //ker dobimo samo stevilo iz forma mu dodamo € da podatek nato shranimo s tem znakom
            $model->price="€".$model->price;
            $model->Booking="not_booked";
            $model->user=Yii::$app->user->identity->username;
            $model->user=Yii::$app->user->getId();
            //da premestimo sliko iz temporery loc v assets/car_photos
            $model->saveLinkToPhoto();

            $_SESSION["adding"]= "jep";
            $this->refresh();
        }else{
            if(isset($_SESSION['temp_photo_loc'])&& !isset($_SESSION["incomming"])){
                //v to vstopimo, če imamo nastavljeno temp_photo_loc(vendar nismo kliknili na select image(nismo spreminjali temp_photo_loc))
                unset($_SESSION['temp_photo_loc']);
                unset($_SESSION['select_change']);
            }else{
                if(isset($_SESSION["adding"])){
                    //ko smo pritisnili submit, lahko izbrisemo select change and adding(je samo zato da pridemo sem notri)
                    unset($_SESSION["adding"]);
                    unset($_SESSION['select_change']);
                    //unset($_SESSION['tmp_photo_loc']);
                    //poglej ko pridemo sem s sliko
                }elseif(isset($_SESSION["incomming"])){//changing image
                    unset($_SESSION["fist_time"]);
                    //da spremenimo button iz Select image v Change image
                    $_SESSION["select_change"] = "change";
                }else{
                    unset($_SESSION["select_change"]);
                    //tukaj notri pridemo, če v session ni settano adding ali pa temp_photo_loc
                    //da vemo da renderamo prvič
                    $_SESSION["fist_time"]="first";
                }
            }
            
            $model->setDataToModel();

            return $this->render("add_cars", ["model"=>$model]);
        }
    }


    public function actionCar_info(){
        $model = new car_info();
        if($model->load(Yii::$app->request->post())){
            $books_in_history = car_info::find()->where(["and","car_id=".intval($_GET["id"]),["or",['>=', 'booking_date', date("Y-m-d")],['>=', 'booking_date_until', date("Y-m-d")]]])->all();
            if(count($books_in_history)!=0 && $model->booking_date>=date("Y-m-d")&&$model->booking_date<$model->booking_date_until){
                $not_jet=true;
                foreach($books_in_history as $carsh){
                    if($carsh->booking_date>=$model->booking_date&&$carsh->booking_date<=$model->booking_date_until){
                        $_SESSION["error"]="Avto je že rezerviran od ".$carsh->booking_date . " do " .$carsh->booking_date_until.", zato izberite drug datum.";
                        return $this->refresh();
                    }elseif($carsh->booking_date_until>=$model->booking_date&&$carsh->booking_date_until<=$model->booking_date_until){
                        //datum katerega izberemo se začne z datumom ki je med tem datumom in konča z datumom, ki je zunaj $carsh datuma
                        $_SESSION["error"]="Avto je že rezerviran od ".$carsh->booking_date . " do " .$carsh->booking_date_until.", zato izberite drug datum.";
                        return $this->refresh();
                    }elseif($carsh->booking_date<=$model->booking_date&&$carsh->booking_date_until>=$model->booking_date_until){
                        $_SESSION["error"]="Avto je že rezerviran od ".$carsh->booking_date . " do " .$carsh->booking_date_until.", zato izberite drug datum.";
                        return $this->refresh();
                    }else {
                       $not_jet=false;
                    }
                }
                if(!$not_jet){
                    $model->user = Yii::$app->user->identity->username;
                    $model->car_id=$_GET["id"];
                    $model->save();
                    //redirectamo na actionDisplay_cars, da ponovno izpišemo vse avtomobile z istim iskanjem
                    return $this->redirect(["site/display_cars",]);
                }
            }else{
                if(!($model->booking_date<$model->booking_date_until)){
                    $_SESSION["error"] = "End date is smaller than Start date.";
                    return $this->refresh();
                }else if($model->booking_date<date("Y-m-d")){
                    $_SESSION["error"] = "Start date is smaller than today's date.";
                    return $this->refresh();
                }else{
                    $model->user = Yii::$app->user->identity->username;
                    $model->car_id=$_GET["id"];
                    $model->save();
                    //redirectamo na actionDisplay_cars, da ponovno izpišemo vse avtomobile z istim iskanjem
                    return $this->redirect(["site/display_cars",]);
                }
            }
        }else{
            return $this->render("car_info",["model"=>$model]);
        }
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }
}
