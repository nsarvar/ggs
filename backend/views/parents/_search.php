<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ParentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'father_name') ?>

    <?= $form->field($model, 'mother_name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'mobile_phone') ?>

    <?php // echo $form->field($model, 'home_phone') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
