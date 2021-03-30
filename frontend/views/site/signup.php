<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\SignupAsset;
use yii\helpers\BaseHtml;
SignupAsset::register($this);
?>
<div style="width:40%;height: 10vh;margin:10vh auto 0 auto;"><img src="assets/porsche1.jpg" style="width:100%;height:10vh"></div>
<div class="site-signup">
    <h1>Registracija</h1>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'first_name',['template'=>"{input}\n{hint}\n{error}"])->textInput(['autofocus' => true, 'style'=>'border:0; border-bottom:1px solid black; border-radius:0;'])->input('first_name', ['placeholder' => " Ime"]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'last_name',['template'=>"{input}\n{hint}\n{error}"])->textInput(['autofocus' => true, 'style'=>'border:0; border-bottom:1px solid black; border-radius:0;'])->input('last_name', ['placeholder' => " Priimek"]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" >
            <?= $form->field($model, 'username',['template'=>"{input}\n{hint}\n{error}"])->input('username', ['placeholder' => " Uporabniško ime"]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" >
            <?= $form->field($model, 'email',['template'=>"{input}\n{hint}\n{error}"])->input('email', ['placeholder' => " E-poštni naslov"]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'password',['template'=>"{input}\n{hint}\n{error}"])->passwordInput(["placeholder"=>" Geslo"]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'confirm_password',['template'=>"{input}\n{hint}\n{error}"])->passwordInput(["placeholder"=>" Potrdi geslo"]) ?>
        </div>
    </div>
    <div class="row" style="padding-bottom: 50px; margin-top: 20px">
        <div class="form-group col-lg-12">
            <?= Html::submitButton('Registracija', ['class' => 'btn btn-primary', 'name' => 'signup-button', "style"=>"background-color:#78B0B7; border:0; width:100%; border-radius:0; line-height:35px;"]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
