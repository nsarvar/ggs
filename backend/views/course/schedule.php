<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18.02.18
 * Time: 18:58
 */

use common\components\TimeTable;
use kartik\field\FieldRange;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */
/* @var $course common\models\Course */
/* @var $form ActiveForm */
$this->title = Yii::t('main','"{course}"ni dars jadvali',['course' => $course->title]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $course->title, 'url' => ['view', 'id' => $course->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-form">
    <h2><?=$this->title?></h2>
    <div class="col-lg-4 col-md-4">

        <h3><?=Yii::t('main','Yangi vaqt kiritish')?></h3>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'course_id')->hiddenInput(['value' => $course->id])->label(false) ?>

        <?= $form->field($model, 'day')->dropDownList(TimeTable::getDays()) ?>

        <?= FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => Yii::t('main','Kurs vaqtini kiriting'),
            'attribute1' => 'start_time',
            'attribute2' => 'end_time',
            'type' => FieldRange::INPUT_TIME,
            'widgetOptions1' => [
                'pluginOptions' => [
                    'showMeridian' => false,
                ]
            ],
            'widgetOptions2' => [
                'pluginOptions' => [
                    'showMeridian' => false,
                ]
            ],


        ]); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-8 col-md-8">
        <?php if($course->getSchedules()->exists()) { ?>
            <div class="schedules">
                <h3><?=Yii::t('main','Kurs bo\'ladigan vaqtlari')?></h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th><?=Yii::t('main','Day')?></th>
                            <th><?=Yii::t('main','Start Time')?></th>
                            <th><?=Yii::t('main','End Time')?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($course->getSchedules()->all() as $schedule) { ?>
                            <tr>
                                <td><?=$schedule->dayName?></td>
                                <td><?=$schedule->startTime?></td>
                                <td><?=$schedule->endTime?></td>
                                <td><?= Html::a('<i class="glyphicon glyphicon-trash color-danger"></i>',['/course/delete-schedule/'.$schedule->id],[
                                            'class' => 'color-danger',
                                            'data-confirm' => Yii::t('main','Siz rostdan ham ushbu ma\'lumotni o\'chirmoqchimisiz?'),
                                            'title' => 'O\'chirish'
                                        ])?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <div class="clearfix"></div>
            </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>

