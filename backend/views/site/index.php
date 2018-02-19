<?php

/* @var $this yii\web\View */

$this->title = Yii::t('main','Bosh sahifa');
?>
<div class="site-index">

    <div class="jumbotron">
        <h2><?=Yii::t('main', 'Tizimga xush kelibsiz - ') . Yii::$app->user->identity->username?></h2>

    </div>

</div>
