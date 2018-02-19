<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Notice */

$this->title = Yii::t('main', 'Create Notice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
