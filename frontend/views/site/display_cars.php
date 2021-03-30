<?php
/* @var $this yii\web\View */
/* @var $model Cars */

use common\models\User;
use yii\helpers\Html;
use frontend\models\Cars;
use yii\bootstrap\ActiveForm;
use frontend\models\car_info;
use frontend\assets\display_carsAsset;
use yii\helpers\Url;
display_carsAsset::register($this);

?>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
<div class="site-display_cars">
    <div class="filtering">
        <?php $form = ActiveForm::begin(['id' => 'filter']); ?>
        <div style="border:1px solid grey; width:50%;margin-top:10px;margin-left:10px; min-width:150px">
        <p class="p-filter" style="margin-top: 10px;">Znamka avtomobila: <?=$model->car_company?></p>
        <?= $form->field($model, 'car_company',['template'=>"{input}\n{hint}\n{error}"])->textInput(["style"=>"display:none"]) ?>
        <p class="p-filter">Model avtomobila: <?=$model->model?></p>
        <?= $form->field($model, 'model',['template'=>"{input}\n{hint}\n{error}"])->textInput(["style"=>"display:none"]) ?>
        </div>
        <p class="p-filter" style="margin-top: 20px;">Price to</p>
        <?= $form->field($model, 'price',['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["Price_to"=>"Cena do","€500"=>"€500","€1000"=>"€1000","€1500"=>"€1500","€2000"=>"€2000","€2500"=>"€2500","€3000"=>"€3000","€4000"=>"€4000","€5000"=>"€5000","€6000"=>"€6000","€7000"=>"€7000","€8000"=>"€8000","€9000"=>"€9000","€10000"=>"€10000","€125000"=>"€12500","€15000"=>"€15000","€17500"=>"€17500","€17500"=>"€17500","€20000"=>"€20000","€25000"=>"€25000","€30000"=>"€30000","€40000"=>"€40000","€50000"=>"€50000","€75000"=>"€75000","€100000"=>"€100000"]) ?>
        <?php
        $years=["First_registration"=>"Leto prve registracije"];
        for($a=0;$a<121;$a++){
            $years[2020-$a]=2020-$a;
        }
        ?>
        <p class="p-filter">Prva registracija</p>
        <?= $form->field($model, 'year',['template'=>"{input}\n{hint}\n{error}"])->dropDownList($years) ?>
        <p class="p-filter">Tip menjalnika</p>
        <?= $form->field($model, "gearing_type",['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["all"=>"Vsi","manual"=>"Manual","automatic"=>"Automatic"])?>
        <p class="p-filter">Vrata</p>
        <?= $form->field($model, "dors",['template'=>"{input}\n{hint}\n{error}"])->textInput(["type"=>"number"])?>
        <p  class="p-filter">Sedeži</p>
        <?= $form->field($model, "seats",['template'=>"{input}\n{hint}\n{error}"])->textInput(["type"=>"number"])?>
        <p  class="p-filter">Tip goriva</p>
        <?= $form->field($model, "fuel_type",['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["all"=>"Vsi","diesel"=>"Diezel","gasoline"=>"Bencin"])?>
        <p  class="p-filter">Moč motorja do (kW):</p>
        <?= $form->field($model, "engine_power",['template'=>"{input}\n{hint}\n{error}"])->textInput(["type"=>"number","style"=>"margin-bottom:30px"])?>
        <?= Html::submitButton('Išči', ['class' => 'btn btn-primary', 'name' => 'search-button',"style"=>"display:block;margin:0 auto 20px auto"]) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="cars">
        <?php
        $all_filtering=["car_company"=>$model->car_company,"model"=>$model->model];
        if($model->price!="Price_to"){
            $price_filtering=["<=","price",$model->price];
        }else{
            $price_filtering=[];
        }
        if($model->year!="First_registration"){
            $all_filtering["year"]=$model->year;
        }
        if($model->gearing_type && $model->gearing_type!="all"){
            $all_filtering["gearing_type"]=$model->gearing_type;
        }
        if($model->dors!=""){
            $all_filtering["dors"]=$model->dors;
        }
        if($model->seats!=""){
            $all_filtering["seats"]=$model->seats;
        }
        if($model->fuel_type && $model->fuel_type!="all"){
            $all_filtering["fuel_type"]=$model->fuel_type;
        }
        if($model->engine_power!=""){
            $engine_filtering=["<=","engine_power",$model->engine_power];
        }else{
            $engine_filtering="noething";
        }
        if($engine_filtering!="noething"){
            $cars = Cars::find()->where($all_filtering)->andWhere($price_filtering)->andWhere($engine_filtering)->all();
        }else {
            $cars = Cars::find()->where($all_filtering)->andWhere($price_filtering)->all();
        }
        if(count($cars)==0){
            echo '<h1>No cars match your filters<h1>';
        }else{
            if(isset($_GET["page_number"])){
                $part_of_cars=array_slice($cars,(25*($_GET["page_number"]-1)),25);//da dobimo naslednjih 25 avtomobilov odvisno od tega, katero povezavo smo zbrali
                unset($_GET["page_number"]);
            }else{
                $part_of_cars=array_slice($cars,0,25);//da dobimo samo prvih 25 avtomobilov
            }
            $query_length=count($cars);
            foreach($part_of_cars as $car){echo
                '<a href="/index.php?r=site%2Fcar_info&id='?><?=$car->id?><?='"><div class="car">
                    <div class="main-heading"><h2 style="margin-left: 2%; padding-top: 15px">'?><?php echo $car->car_company . " " . $car->model . " <span class='user_span'>(Od uporabnika: </span>" . (User::find()->where("id=".$car->user)->one())->username;?><?='<span class="user_span">)</span></h2></div>
                    <div class="picture" style="background:url(/assets/'?><?php if($car->car_photo=="no_photo"){echo "no_photo";}else{echo "car_photos/". $car->car_photo;}?><?='.png); background-size: cover"></div>
                    <div class="cars_content">
                        <div class="row" style="margin: 0">
                            <div class="col-sm-3">
                                <h2 style="margin-block-start: 0!important;margin: 0!important;height: 40px">'?><?= $car->price ?><?='</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" style="border-bottom: 1px solid grey; margin-right: 2%"><p>Moč motorja do (kW): <span>'?><?= $car->engine_power ?><?='</span></p></div>
                            <div class="col-sm-4" style="border-bottom: 1px solid grey; margin-right: 2%"><p>Število vrat: <span>'?><?= $car->dors ?><?='</span></p></div>
                            <div class="col-sm-4" style="border-bottom: 1px solid grey"><p>Tip menjalnika: <span>'?><?= $car->gearing_type ?><?='</span></p></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" style="margin-right: 2%""><p>Tip goriva: <span>'?><?php if($car->fuel_type=="diesel"){echo "Diezel";}else{echo "Bencin";} ?><?='</span></p></div>
                            <div class="col-sm-4" style="margin-right: 2%""><p>Število sedežev: <span>'?><?= $car->seats ?><?='</span></p></div>
                            <div class="col-sm-4"><p>Leto prve registracije: <span>'?><?= $car->year?><?='</span></p></div>
                        </div>'?>
                        <?php
                        if(Yii::$app->user->isGuest){
                        }else{ 
                            $books_in_history = car_info::find()->where(["car_id"=>$car->id])->andWhere(['<=', 'booking_date', date("Y-m-d")])->andWhere(['>=', 'booking_date_until', date("Y-m-d")])->all();
                            if($books_in_history!=null){
                                echo "<div class='row'><div class='col-sm-12 booking_message' style='background-color:#fc8981'><h4 style='line-height:100%; background-color:#fc8981'>Avto je trenutno rezerviran, vendar ga lahko rezervirate za pozneje.</h4></div></div>";
                            }else{
                                echo "<div class='row'><div class='col-sm-12 booking_message'><h4 style='line-height:100%'>Trenutno ni rezerviran</h4></div></div>";
                            }
                        }
                        ?>
                <?='</div>
            </div></a>';}
            
            if($query_length>25){
                $devided = ceil($query_length/25);
                echo "<div style='display:flex;justify-content:flex-end;'>";
                for($i=1;$i<=$devided;$i++){
                    echo "<a href='".Url::to(["site/display_cars", "page_number"=>$i])."' style='background-color:#fafafa; border:1px solid grey;margin-left:5px; padding: 3px 6px;color:black'>".$i."</a>";
                }
                echo "</div>";
            }
        }?>
    </div>
</div>
