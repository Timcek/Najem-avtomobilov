<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Burek */

$this->title = 'Create Burek';
$this->params['breadcrumbs'][] = ['label' => 'Bureks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="burek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
