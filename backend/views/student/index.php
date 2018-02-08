<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('main', 'Create Student'), ['create-student'], ['class' => 'btn btn-success']) ?>
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
            //'email:email',
            'passport',
            'address:ntext',
            //'phone',
            //'parent_id',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'freetime'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['/student/free-times','id'=>$model['id']]); //$model->id для AR
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-time"></span>', $customurl,
                            ['title' => Yii::t('yii', 'Free times'), 'data-pjax' => '0']);
                    }
                ],
                'template'=>'{view} {freetime} {update} {delete}',

            ],
        ],
    ]); ?>
</div>
