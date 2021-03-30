<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\LoginAsset;
use yii\helpers\Url;
LoginAsset::register($this);

$this->title = 'Prijava uporabnika';
?>

<div class="site-log">
    <div class="photo">
        <img src="<?=Url::to('@web/assets/person.png')?>">
    </div>
    <div class="container-of-lines">
        <h1 class="name"><?= Html::encode($this->title) ?></h1>
        <div class="lines">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username',['template'=>"{input}\n{hint}\n{error}"])->textInput(['autofocus' => true])->error(["style"=>"margin-left:15px; color:grey;padding-bottom:9px"])->input('username', ['placeholder' => "Uporabniško ime"]) ?>

                <?= $form->field($model, 'password',['template'=>"{input}\n{hint}\n{error}"])->passwordInput()->error(["style"=>"margin-left:15px; color:grey; padding-bottom:15px"])->input('password', ['placeholder' => "Geslo"]) ?>
<!--                <?//= $form->field($model, 'rememberMe')->checkbox() ?>-->



                <div style="text-align: center">
                    <?= Html::submitButton('Prijava', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
