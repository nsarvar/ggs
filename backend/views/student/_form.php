<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */

?>
<style>
    .avatar-upload{
        max-width: 210px;
        max-height: 160px;
    }
</style>
<div class="student-form">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'removeLabel' => Yii::t('main','Delete'),
                'browseLabel' => Yii::t('main','Rasm tanlang'),
                'showUpload' => false,
                'deleteUrl' => empty($model->avatarModel->filename) ? '#' : '/files/delete-file/' . $model->avatarModel->filename,
                'initialPreview' => empty(!$model->avatarModel) && $model->avatarModel->hasFile ? [Html::img($model->avatarModel->relativeLink,['class' => 'avatar-upload'])] : []
            ]
        ]
    ) ?>

    <?= $form->field($model, 'bdate')->widget(DatePicker::className(),[
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
