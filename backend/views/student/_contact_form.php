<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/06
 * Time: 21:45
 */

/* @var $model common\models\Student */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tab-form">
    <?php $form = ActiveForm::begin() ?>

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