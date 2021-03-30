<?php 
/* @var $model Cars */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Cars;
use frontend\models\BookingHistory;
use frontend\assets\car_infoAsset;
use phpDocumentor\Reflection\Types\True_;

car_infoAsset::register($this);

?>
<div style="width:80%; height:300px; background-color: #faf5f5; margin: 0 auto; <?php if(Yii::$app->user->isGuest){echo "margin-top: 20vh";}?>">
    <?php $informations_of_car = Cars::findOne(["id"=>$_GET["id"]])?>
    <?='<div style="width: 300px;background:url(/assets/'?><?php if($informations_of_car->car_photo=="no_photo"){echo "no_photo";}else{echo "car_photos/".$informations_of_car->car_photo;}?><?='.png);background-size: cover; height:300px;display: inline-block"></div>'?>
    <div style="width: 45%; float: right">
        <h2 style="text-align:center"><?= $informations_of_car->car_company?> <?= $informations_of_car->model?></h2>
        <h5>Leto: <?= $informations_of_car->year?></h5>
        <h5>Cena: <?= $informations_of_car->price?></h5>
        <h5>Moč motorja (kW): <?= $informations_of_car->engine_power?>kW</h5>
        <h5>Vrata: <?= $informations_of_car->dors?></h5>
        <h5>Sedeži: <?= $informations_of_car->seats?></h5>
        <h5>Tip menjalnika: <?= $informations_of_car->gearing_type?></h5>
        <h5>Tip goriva: <?php if($informations_of_car->fuel_type=="diesel"){echo "Diezel";}else{echo "Bencin";}?></h5>
    </div>
</div>
<?php 
//da se lahko uspešno vrnemo na prejšnjo stran
//$_SESSION["to_go_back"]=true;
if(Yii::$app->user->isGuest){
}else{
    if($informations_of_car->Booking=="not_booked"){
        echo 
        '<div style="width: 80%;'?><?php if(isset($_SESSION["error"])){echo 'margin:50px auto 0 auto;';}else{echo ' margin:50px auto;';}?><?='background-color:#f2f0f0">
            <div class="row">'?>
            <?php $form = ActiveForm::begin(['id' => 'form-book']); ?>
                <?='<div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-6"><h3 style="margin-left:13px;">Začetni datum</h3></div>
                        <div class="col-sm-6"><h3>Končni datum</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">'?><?= $form->field($model,"booking_date")->input("date",["style"=>"margin-left:13px;min-width:130px"])->label("")->error(["style"=>"margin-left:13px"])?><?='</div>
                        <div class="col-sm-6">'?><?= $form->field($model,"booking_date_until")->input("date",["style"=>"min-width:130px"])->label("")?><?='</div>
                    </div>
                </div>
                <div class="col-sm-3">'?>
                    <?= Html::submitButton('Najemi avto', ['class' => 'btn btn-primary', 'name' => 'search-button', "style"=>"background-color:#78B0B7; border:0; width:100%; border-radius:0; line-height:35px; margin-top:39px"]) ?>
                <?='</div>'?>
            <?php ActiveForm::end(); ?>
            <?='</div>
        </div>  '?><?php if(isset($_SESSION["error"])){
            echo '<div style="width: 80%; margin:0 auto; background-color:#f2f0f0"><h3 style="background-color:#f22e62; margin-top:0;line-height:40px">'?><?=$_SESSION["error"]?><?='</h3></div>';
            unset($_SESSION["error"]);
        };
    }

    echo    
    '<div style="width: 80%; margin:50px auto; background-color:#f2f0f0">
    <div class="row" style="width:100%; border-bottom:1px solid black;margin-bottom:5px;padding-bottom:5px;padding-top:5px">
        <div class="col-sm-4">Datum začetka najema</div>
        <div class="col-sm-4">Najet do</div>
        <div class="col-sm-4">Uporabnik, ki ga je najel</div>
    </div>'?>
    <?php 
    $history=BookingHistory::findAll(["car_id"=>$_GET["id"]]);

    foreach($history as $hist_car){
        echo 
        '<div class="row">
            <div class="col-sm-4">'?><?=$hist_car->booking_date?><?='</div>
            <div class="col-sm-4">'?><?=$hist_car->booking_date_until?><?='</div>
        <div class="col-sm-4">'?><?=$hist_car->user?><?='</div>
        </div>';
    }
    ?>
<?='</div>';}?>

<style>
    .row{
        margin-right: 0;
        margin-left: 0;
    }
</style>
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("car_info-booking_date").setAttribute('min', today);
    document.getElementById("car_info-booking_date_until").setAttribute('min', today);
</script>

