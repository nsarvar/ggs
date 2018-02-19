<?php

use common\models\Subject;
use kartik\checkbox\CheckboxX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-6 col-md-6">

        <?= $form->field($model, 'parent_id')->dropDownList(Subject::getMainSubjectsAsMap($model->id),[
            'prompt' => Yii::t('main','Asosiy fanni yo\'q')
        ]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    </div>

    <div class="col-lg-6 col-md-6">
                <h3><?=Yii::t('main','Categories')?></h3>
                <?php foreach (\common\models\Category::getAllModels() as $cat) {
                    $name = 'cat-'.$cat->id;
                    ?>
                    <div class="form-group has-success">
                    <label class="cbx-label" for="<?=$name?>">
                    <?php
                    echo CheckboxX::widget([
                        'name' => $name,
                        'options' => ['id' => $name],
                        'value' => !$model->isNewRecord && $cat->hasValue($model->id),
                        'pluginOptions'=>['threeState'=>false]
                    ]);
                    echo $cat->name;
                    echo '</label><br></div>';
                }  ?>
    </div>

        <div class="form-group col-xs-12">
            <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
