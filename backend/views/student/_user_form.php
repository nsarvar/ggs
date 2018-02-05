<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/05
 * Time: 22:13
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div>
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($user, 'username')->textInput() ?>

    <?= $form->field($user, 'email')->textInput() ?>

    <?= $form->field($model,'fname')->textInput()?>

    <?= $form->field($model, 'lname')->textInput() ?>

    <?= $form->field($model, 'passport')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
