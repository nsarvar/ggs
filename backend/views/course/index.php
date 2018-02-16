<?php

use common\models\CourseGroup;
use common\models\Faculty;
use common\models\Subject;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Courses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('main', 'Create Course'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['style'=>'width: 30px;']
            ],
            [
                'attribute' => 'subject_id',
                'filter' => Subject::getModelsAsMap(),
                'content' => function($data) {
                    return $data->subjectName;
                }
            ],
            [
                'attribute' => 'course_group_id',
                'filter' => CourseGroup::getAllModelsAsMap(),
                'content' => function($data) {
                    return $data->catName;
                }
            ],
            [
                'attribute' => 'faculty_id',
                'filter' => Faculty::getAllModelsAsMap(),
                'content' => function($data) {
                    return $data->facultyName;
                }
            ],
            'title',
//            'desciption:ntext',
//            'other_detail:ntext',
            //'course_group_id',
            //'faculty_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'enroll'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['/course/enroll','id'=>$model['id']]); //$model->id для AR
                        return Html::a( '<span class="glyphicon glyphicon-paperclip"></span>', $customurl, [
                                    'title' => Yii::t('yii', 'Kursga yozilish'), 'data-pjax' => '0'
                                ]);
                    },
                    'enrollStudents' => function($url, $model) {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['/course/enroll-student','id' => $model['id']]);
                        return Html::a('<span class="glyphicon glyphicon-user"></span>',$customurl,[
                                'title' => Yii::t('main','Kurs o\'quvchilari'), 'data-pjax' => '0'
                        ]);
                    }
                ],
                'template'=>'{enrollStudents} {view} {enroll} {update} {delete}',
            ],
        ],
    ]); ?>
</div>
