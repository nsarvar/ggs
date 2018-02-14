<?php

use common\models\CourseGroup;
use common\models\Faculty;
use common\models\Subject;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_id')->dropDownList(Subject::getModelsToSelect()) ?>

    <?= $form->field($model, 'course_group_id')->dropDownList(CourseGroup::getAllModelsAsMap()) ?>

    <?= $form->field($model, 'faculty_id')->dropDownList(Faculty::getAllModelsAsMap(),[
            'prompt' => Yii::t('main','O\'qituvchi hali yo\'q')
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desciption')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_detail')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
