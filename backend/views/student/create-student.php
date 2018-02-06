<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/05
 * Time: 21:59
 */
$this->title = Yii::t('main','Yangi o\'quvchi qo\'shish');
?>

<div class="create-student-form">
    <h2 class="text-center"><?=Yii::t('main','Asosiy ma\'lumotlar')?></h2>

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('main','Asosiy'),
                'content' => $this->render('_user_form',['model' => new \common\models\Student(), 'user' => new \frontend\models\SignupForm()]),
                'active' => true
            ],
            [
                'label' => Yii::t('main','Kontaklar'),
                'url' => '/student/create-student-2',
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
