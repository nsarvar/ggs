<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/06
 * Time: 21:37
 */
$this->title = Yii::t('main','Yangi o\'quvchi qo\'shish');
?>


<div class="create-student-form">
    <h2 class="text-center"><?=Yii::t('main','Kontakt ma\'lumotlar')?></h2>

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('main','Asosiy'),
                'url' => '/student/create-student'
            ],
            [
                'label' => Yii::t('main','Kontaklar'),
                'content' => $this->render('_contact_form',[ 'model' => $model]),
                'active' => true
            ],
            [
                'label' => Yii::t('main','Fanlar'),
                'url' => '/student/create-student-3',
            ],
            [
                'label' => Yii::t('main','Dars jadvali'),
                'url' => '/student/create-student-4',
            ]
        ]
    ]) ?>
</div>

