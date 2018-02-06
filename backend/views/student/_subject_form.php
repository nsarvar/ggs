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

    <?php foreach ($models as $model) {
        echo Html::checkbox('subject'.$model['id'], false, ['label' => $model['name']]);
        echo '<br>';
        ?>
    <?php } ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>