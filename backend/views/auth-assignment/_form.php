<?php

use common\models\AuthItem;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList(AuthItem::getAllModelsAsMap(),[
            'prompt' => 'Ro\'l yoki huquqni tanlang',
            'onchange' => '
                $("select#authassignment-user_id").html("<option value=\'0\'>-</option>");
                $.get("/auth-item/get?id="+$(this).val(), function( data ) {
                $("select#authassignment-user_id").html( data );
                $("select#authassignment-user_id").prop( "disabled", false );
            });',
    ]) ?>

    <?= $form->field($model, 'user_id')->dropDownList([],
        [
          'disabled' => true
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
