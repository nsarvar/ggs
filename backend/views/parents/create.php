<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Parents */

$this->title = Yii::t('main', 'Create Parents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Parents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
