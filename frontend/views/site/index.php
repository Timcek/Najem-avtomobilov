<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model Cars */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\IndexAsset;
use yii\helpers\Url;
IndexAsset::register($this);

$this->title = 'Najem avtomobilov';
?>
<div class="site-index">
    <?php $form = ActiveForm::begin([
        'id' => 'form-search',
        "action"=>Url::to(['site/display_cars'])]); ?>
    <div class="wrapping">
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'car_company',['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["Audi"=>"Audi","BMW"=>"BMW","Mercedes-benz"=>"Mercedes-benz"],["class"=>"form-control company","selected",'style'=>'border:0; border-bottom:1px solid black; border-radius:0;'])->label('')?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'model',['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["50"=>"50","60"=>"60","80"=>"80","90"=>"90","100"=>"100","200"=>"200","A1"=>"A1","A2"=>"A2","A3"=>"A3","A4"=>"A4","A4 Allroad"=>"A4 Allroad","A5"=>"A5","A6"=>"A6","A6 Allroad"=>"A6 Allroad","A7"=>"A7","A8"=>"A8","Co"=>"Coupe","Cabriolet"=>"Cabriolet","E-Tron"=>"E-Tron","Q1"=>"Q1","Q2"=>"Q2","Q3"=>"Q3","Q5"=>"Q5","Q7"=>"Q7","Q8"=>"Q8","R8"=>"R8","RS2"=>"RS2","RS3"=>"RS3","RS4"=>"RS4","RS5"=>"RS5","RS6"=>"RS6","RS7"=>"RS7","RS Q3"=>"RS Q3","RS Q5"=>"RS Q5","RS Q8"=>"RS Q8","S1"=>"S1","S2"=>"S2","S3"=>"S3","S4"=>"S4","S5"=>"S5","S6"=>"S6","S7"=>"S7","S8"=>"S8","SQ2"=>"SQ2","SQ5"=>"SQ5","SQ7"=>"SQ7","SQ8"=>"SQ8","TT"=>"TT","V8"=>"V8"],['style'=>'border:0; border-bottom:1px solid black; border-radius:0;']) ?>         
        </div>
    </div>
    <?php
    $years=["First_registration"=>"Leto prve registracije"];
    for($a=0;$a<121;$a++){
        $years[2020-$a]=2020-$a;
    }
    ?>
    <div class="row">
        <div class="col-sm-6" >
            <?= $form->field($model, 'year',['template'=>"{input}\n{hint}\n{error}"])->dropDownList($years) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'price',['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["Price_to"=>"Cena do","€500"=>"€500","€1000"=>"€1000","€1500"=>"€1500","€2000"=>"€2000","€2500"=>"€2500","€3000"=>"€3000","€4000"=>"€4000","€5000"=>"€5000","€6000"=>"€6000","€7000"=>"€7000","€8000"=>"€8000","€9000"=>"€9000","€10000"=>"€10000","€125000"=>"€12500","€15000"=>"€15000","€17500"=>"€17500","€17500"=>"€17500","€20000"=>"€20000","€25000"=>"€25000","€30000"=>"€30000","€40000"=>"€40000","€50000"=>"€50000","€75000"=>"€75000","€100000"=>"€100000"]) ?>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="form-group col-lg-12">
            <?= Html::submitButton('Išči', ['class' => 'btn btn-primary', 'name' => 'search-button', "style"=>"background-color:#78B0B7; border:0; width:100%; border-radius:0; line-height:35px;"]) ?>
        </div>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

