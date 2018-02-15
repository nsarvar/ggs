<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.02.18
 * Time: 9:51
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $course common\models\Course */
/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentEnrollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main','"{course}"ga yozilish',['course' => $course->title]);
?>

<div class="course-enroll">

    <h1><?=$this->title?></h1>
    <h4 class="course-diff">
        <?=Yii::t('main','Kursda <span>{count} ta </span> bo\'sh joy bor.',['count' => $course->diff])?>
        &ensp;
        <?= Yii::t('main','Belgilandi <span> <span id="count-enroll">{count}</span> ta </span>',['count' => 0])?>
    </h4>
    <?php ActiveForm::begin() ?>
    <p>
        <button class="btn btn-success" type="submit"><?=Yii::t('main','Kursga yozish')?></button>
        <?= Html::a(Yii::t('main', Yii::t('main','Kurs o\'quvchilari')), ['enroll-student', 'id' => $course->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['style'=>'width: 30px;']
            ],
            'fname',
            'lname',
            'bdate',
            'passport',
            [
                'filter' => Html::checkbox('enroll-all',false,['id' => 'enroll-all']),
                'content' => function($data) {
                    return Html::checkbox('enroll['.$data->id.']',false,['data-type' => 'check', 'class' => 'enroll-check']);
                },
                'options' => ['class' => 'text-center']
            ],
        ],
        'tableOptions' => [
            'class'=>'table table-striped table-bordered text-center-table'
        ],
    ]); ?>
    <?php ActiveForm::end() ?>

</div>
