<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = $model->lname.' '.$model->fname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('main', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('main', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('main', 'Free times'), ['free-times', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'code',
                    'fname',
                    'lname',
                    'bdate',
                    'email:email',
                    'passport',
                    'address:ntext',
                    'phone',
                    'parent_id',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>

        </div>
        <div class="col-lg-6 col-md-6 text-center">
            <img src="<?=$model->avatarImage?>" alt="<?=Yii::t('main','avatar')?>" class="avatar-image">
        </div>
    </div>


</div>
