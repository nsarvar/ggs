<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/05
 * Time: 21:59
 */

?>

<div>
    <h2 class="text-center"><?=Yii::t('main','Yangi o\'quvchi qo\'shish')?></h2>

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('main','Asosiy'),
                'content' => $this->render('_user_form',['model' => new \common\models\Student(), 'user' => new \frontend\models\SignupForm()]),
                'active' => true
            ],
            [
                'label' => 'Two',
                'content' => 'Anim pariatur cliche...',
//                'headerOptions' => ,
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Example',
            'url' => 'http://www.example.com',
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                [
                    'label' => 'DropdownA',
                    'content' => 'DropdownA, Anim pariatur cliche...',
                ],
                [
                    'label' => 'DropdownB',
                    'content' => 'DropdownB, Anim pariatur cliche...',
                ],
                [
                    'label' => 'External Link',
                    'url' => 'http://www.example.com',
                ],
            ],
        ],
    ],
    ]) ?>
</div>
