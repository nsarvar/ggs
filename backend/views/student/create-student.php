<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/05
 * Time: 21:59
 */
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('main','Yangi o\'quvchi qo\'shish');
?>

<div class="create-student-form">

    <?php $form = ActiveForm::begin(['action' => '/student/save-user']) ?>

    <?= $form->field($model,'fname')->textInput()?>

    <?= $form->field($model, 'lname')->textInput() ?>

    <?= $form->field($model, 'passport')->textInput() ?>

    <?= $form->field($model,'bdate')->widget(DatePicker::className(),[
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>


    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model,'email')->textInput()?>

    <?= $form->field($model, 'address')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
