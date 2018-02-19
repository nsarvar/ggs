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
    <h2 class="text-center"><?=Yii::t('main','Bo\'sh vaqtlari')?></h2>
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
                'url' => '/student/create-student-3'
            ],
            [
                'label' => Yii::t('main','Dars jadvali'),
                'content' => $this->render('_schedule_form',['weekdays' => $weekdays, 'hours' => $hours]),
                'active' => true
            ]
        ]
    ]) ?>
</div>
