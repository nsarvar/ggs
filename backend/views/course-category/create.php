<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CourseCategory */

$this->title = Yii::t('main', 'Create Course Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Course Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
