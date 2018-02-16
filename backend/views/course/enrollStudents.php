<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/15
 * Time: 22:34
 */

/* @var $course common\models\Course */
/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $course->title;
?>

<div class="course-enroll">

    <h1><?=$this->title?></h1>
    <h4 class="course-diff">
        <?=Yii::t('main','Kurs <span>{count} ta</span> o\'quvchi uchun mo\'ljallangan.',['count' => $course->size])?>
        <?=Yii::t('main','Kursda <span>{count} ta </span> bo\'sh joy bor.',['count' => $course->diff])?>
    </h4>
    <p>
        <?php
        if($dataProvider->totalCount>0)

            echo Html::button(Yii::t('main','Kursdan o\'chirish'),[
                'class' => 'btn btn-danger',
                'data-confirm' => Yii::t('main','Haqiqatdan ham ushbu o\'quvchilarni kursdan o\'chirmoqchimisiz?'),
                'id' => 'enroll-to-course'
            ])
        ?>
        <?= Html::a(Yii::t('main', Yii::t('main','Barcha kurslar')), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('main', Yii::t('main','Kursga yangi o\'quvchi qo\'shish')), ['enroll','id' => $course->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'avatarImage',
                'content' => function($data) {
                    return '<img class="avatar-mini" src="'.$data->avatarImage.'">';
                }
            ],
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
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'delete'=>function ($url, $model)
                    {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['/course/delete-from-enroll/','id'=>$model['id'], 'course' => Yii::$app->session->get('courseId')]); //$model->id для AR
                        return Html::a( '<span class="glyphicon glyphicon-remove-circle"></span>', $customurl,
                            [
                                'title' => Yii::t('yii', 'Kursda o\'chirish'), 'data-pjax' => '0',
                                'data-confirm' => Yii::t('yii', 'Haqiqatdan ham, ushbu o\'quvchini kursdan o\'chirmoqchimisiz?'),
                            ]);
                    },
                    'view'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['/student/view/','id'=>$model['id']]); //$model->id для AR
                        return Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                            ['title' => Yii::t('yii', 'O\'quvchini ko\'rish'), 'data-pjax' => '0']);
                    }
                ],
                'template'=>'{view} {delete}',

            ],
        ],
        'tableOptions' => [
            'class'=>'table table-striped table-bordered text-center-table text-center-table-last-2'
        ],
    ]); ?>
    <?php ActiveForm::begin(['options' => ['id' => 'enroll-form']]) ?>
    <?php ActiveForm::end() ?>

</div>

