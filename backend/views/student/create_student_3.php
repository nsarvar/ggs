<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/06
 * Time: 22:44
 */
$this->title = Yii::t('main','Yangi o\'quvchi qo\'shish');
?>

<div class="create-student-form">
    <h2 class="text-center"><?=Yii::t('main','Dars o\'tadigan fanlari')?></h2>
    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('main','Asosiy'),
                'url' => '/student/create-student',
            ],
            [
                'label' => Yii::t('main','Kontaklar'),
                'url' => '/student/create-student-2',
            ],
            [
                'label' => Yii::t('main','Fanlar'),
                'content' => $this->render('_subject_form',['models' => $models]),
                'active' => true
            ],
            [
                'label' => Yii::t('main','Dars jadvali'),
                'url' => '/student/create-student-4',
            ]
        ]
    ]) ?>
</div>
