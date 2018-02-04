<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FacultyHours */

$this->title = Yii::t('main', 'Create Faculty Hours');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Faculty Hours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faculty-hours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
