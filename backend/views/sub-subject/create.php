<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SubSubject */

$this->title = Yii::t('main', 'Create Sub Subject');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Sub Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
