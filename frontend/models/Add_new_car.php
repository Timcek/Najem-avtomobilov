<?php

namespace frontend\models;

use Yii;
use frontend\models\TempPhotos;

/**
 * This is the model class for table "cars".
 *
 * @property int $id
 * @property string $car_company
 * @property string $model
 * @property int $year
 * @property string $price
 * @property int $engine_power
 * @property int $dors
 * @property int $seats
 * @property string $gearing_type
 * @property string $fuel_type
 * @property string|null $Booking
 * @property string $user
 * @property string $car_photo
 */
class Add_new_car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_company', 'model', 'year', 'price', 'engine_power', 'dors', 'seats', 'gearing_type', 'fuel_type'], 'required'],
            [['year', 'engine_power', 'dors', 'seats'], 'integer'],
            [['car_company', 'price'], 'string', 'max' => 255],
            [['model', 'fuel_type'], 'string', 'max' => 50],
            [['gearing_type'], 'string', 'max' => 100],
            [['Booking'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_company' => 'Car Company',
            'model' => 'Model',
            'year' => 'Year',
            'price' => 'Price',
            'engine_power' => 'Engine Power',
            'dors' => 'Dors',
            'seats' => 'Seats',
            'gearing_type' => 'Gearing Type',
            'fuel_type' => 'Fuel Type',
            'Booking' => 'Booking',
        ];
    }

    public function generateRandomString(){
        do {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 15; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        } while (TempPhotos::findOne(["temp_photo"=>$randomString])!=null);
        return $randomString;
    }


    function savingToTemporary($photoName,$newPhotoName){
        $new_file="C:/Apache24/htdocs/sola-avto-stran/yii-appli/frontend/web/assets/temp/".$newPhotoName.".png";
        rename($photoName,$new_file);
        //TempPhotos je model za dodajanje v podatkovno bazo
        $model_temp = new TempPhotos();
        $model_temp->temp_photo= $newPhotoName;
        $model_temp->save();
        $_SESSION["temp_photo_loc"] = $newPhotoName;
        $_SESSION["incomming"] = "yes";
    }

    function setSessionItems(){
        $_SESSION["car_company"]=$_POST["car_company"]; 
        $_SESSION["model"]=$_POST["model"]; 
        $_SESSION["year"]=$_POST["year"]; 
        $_SESSION["price"]=$_POST["price"]; 
        $_SESSION["engine_power"]=$_POST["engine_power"]; 
        $_SESSION["doors"]=$_POST["doors"]; 
        $_SESSION["seats"]=$_POST["seats"]; 
        $_SESSION["gearing_type"]=$_POST["gearing_type"]; 
        $_SESSION["fuel_type"]=$_POST["fuel_type"]; 
        $_SESSION["count"]=0;
    }

    /*
     * this method moves photo from temp to the car_photos file where the photos are saved and used for displaying cars
    */
    function saveLinkToPhoto(){
        if(isset($_SESSION['temp_photo_loc'])){
            $randomString = $this->generateRandomString();
            $this->car_photo=$randomString;
            $new_file = "C:/Apache24/htdocs/sola-avto-stran/yii-appli/frontend/web/assets/car_photos/".$randomString.".png";
            rename("C:/Apache24/htdocs/sola-avto-stran/yii-appli/frontend/web/assets/temp/".$_SESSION["temp_photo_loc"].".png",$new_file);
            $this->save();
            //da deletamo sliko iz temporery loc
            $temporery = TempPhotos::findOne((["temp_photo"=>$_SESSION['temp_photo_loc']]));
            $temporery->delete();
            //ko damo submit, sliko shranimo in jo potem lahko odstranimo iz session
            unset($_SESSION['temp_photo_loc']);
        }else{
            $this->car_photo="no_photo";
            $this->save();
        }
    }

    /*
     * this method sets data to the module, so when the page refreshes the form contains the data that it had before refresh
    */
    function setDataToModel(){
        if(isset($_SESSION["count"])){
            $this->car_company=$_SESSION["car_company"];
            $this->model=$_SESSION["model"];
            $this->year=$_SESSION["year"];
            $this->price=$_SESSION["price"];
            $this->engine_power=$_SESSION["engine_power"];
            $this->dors=$_SESSION["doors"];
            $this->seats=$_SESSION["seats"];
            $this->gearing_type=strtolower($_SESSION["gearing_type"]);
            $this->fuel_type=strtolower($_SESSION["fuel_type"]);
            $_SESSION["count"]=$_SESSION["count"]+1;
        }
    }
}
