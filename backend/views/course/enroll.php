<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.02.18
 * Time: 9:51
 */

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $course common\models\Course */
/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main','"{course}"ga yozilish',['course' => $course->title]);
?>

<div class="course-enroll">
    <h1><?=$this->title?></h1>

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
            //'email:email',
            'passport',
            'address:ntext',
            //'phone',
            //'parent_id',
            //'created_at',
            //'updated_at',

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

</div>
