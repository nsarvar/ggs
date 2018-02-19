<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Parents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
