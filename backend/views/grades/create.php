<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Grades */

$this->title = Yii::t('main', 'Create Grades');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
