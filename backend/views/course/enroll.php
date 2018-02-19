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
use yii\widgets\Pjax;

/* @var $course common\models\Course */
/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentEnrollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('main','"{course}"ga yozilish',['course' => $course->title]);
$this->title = $course->title;
?>

<div class="course-enroll">

    <h1 class="text-center"><?=$this->title?></h1>
    <h4 class="course-diff text-center">
        <?=Yii::t('main','Kursda <span>{count} ta </span> o\'quvchi uchun mo\'jallangan.',['count' => $course->size])?>
    </h4>
    <br>

    <div class="col-lg-6 col-md-6">
        <p>
            <button class="btn btn-success" id="enroll-to-course" type="submit"><?=Yii::t('main','Kursga yozish')?></button>
        </p>
        <?php Pjax::begin(['id' => 'notenrolled'])?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'contentOptions'=>['style'=>'width: 30px;']
                ],
                [
                    'attribute' => 'fullName',
                    'content' => function($data) {
                        return '<a href="/student/view/'.$data->id.'">'.$data->fullName.'</a>';
                    },
                ],
                'bdate',
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function($model) {
                        return [
                                'value' => $model->id,
                            ];
                    },
                    'name' => 'enroll',
                    'cssClass' => 'enroll-check'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons'=>[
                        'add'=>function ($url, $model)
                        {
                            return Html::a( Yii::t('main','Qo\'shish'), '',
                                [
                                    'title' => Yii::t('yii', 'O\'quvchini joriy kursga qo\'shish'),
                                    'class' => 'add-student btn btn-success',
                                    'data-id' => $model['id'],
                                    'onclick' => 'return addStudent($(this));',
                                ]);
                        },
                    ],
                    'template'=>'{add}',

                ],
            ],
            'tableOptions' => [
                'class'=>'table table-striped table-bordered text-center-table text-center-table-last-2'
            ],
        ]); ?>
        <?php Pjax::end()?>
        <?php ActiveForm::begin(['options' => ['id' => 'enroll-form']]) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-lg-6 col-md-6">
        <p>
            <?php
            if($dataProvider->totalCount>0)

                echo Html::button(Yii::t('main','Kursdan o\'chirish'),[
                    'class' => 'btn btn-danger',
                    'id' => 'delete-from-course'

                ])
            ?>
        </p>
        <?php Pjax::begin(['id' => 'enrolled']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider2,
            'filterModel' => $searchModel2,
            'columns' => [
//                [
//                    'attribute' => 'avatarImage',
//                    'content' => function($data) {
//                        return '<img class="avatar-mini" src="'.$data->avatarImage.'">';
//                    }
//                ],
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'id',
                    'contentOptions'=>['style'=>'width: 30px;']
                ],
                [
                    'attribute' => 'fullName',
                    'content' => function($data) {
                        return '<a href="/student/view/'.$data->id.'">'.$data->fullName.'</a>';
                    },
                ],
                'bdate',
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function($model) {
                        return [
                            'value' => $model->id,
                        ];
                    },
                    'name' => 'enroll',
                    'cssClass' => 'enroll-check-2'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons'=>[
                        'delete'=>function ($url, $model)
                        {
                            return Html::a( Yii::t('yii', 'O\'chirish'), '',
                                [
                                    'title' => Yii::t('yii', 'O\'quvchini joriy kursdan o\'chirish'),
                                    'class' => 'remove-student btn btn-danger',
                                    'data-id' => $model['id'],
                                    'onclick' => 'return removeStudent($(this));',
                                ]);
                        },
                    ],
                    'template'=>'{delete}',

                ],
            ],
            'tableOptions' => [
                'class'=>'table table-striped table-bordered text-center-table text-center-table-last-2'
            ],
        ]); ?>
        <?php Pjax::end()?>
        <?php ActiveForm::begin(['options' => ['id' => 'enroll-form-2']]) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="clearfix"></div>

</div>
<input type="hidden" value="<?=Yii::t('yii', 'Haqiqatdan ham, ushbu o\'quvchini kursdan o\'chirmoqchimisiz?')?>" id="confirm-message">
<input type="hidden" value="<?=Yii::t('main','Haqiqatdan ham ushbu o\'quvchilarni kursdan o\'chirmoqchimisiz?')?>" id="confirm-message-2">
<input type="hidden" value="<?=$course->id?>" id="course" name="course">
