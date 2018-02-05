<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => Yii::t('main','Kontent'),'icon' => 'book', 'url' => '#', 'items' => [
                        ['label' => Yii::t('main','Subjects'), 'url' => ['/subject/index']],
                        ['label' => Yii::t('main','Students'), 'url' => ['/students/index']]
                    ]],
                    ['label' => Yii::t('main','Dashboard'), 'icon' => 'home', 'url' => ['/']],
                    ['label' => Yii::t('main','Students'), 'icon' => 'users', 'url' => ['#']],
                    ['label' => Yii::t('main','Teachers'), 'icon' => 'user-secret', 'url' => ['#']],
                    ['label' => Yii::t('main','Finance'), 'icon' => 'money', 'url' => ['#']],
                    ['label' => Yii::t('main','Courses'), 'icon' => 'list-alt', 'url' => ['#']],
                    ['label' => Yii::t('main','Time table'), 'icon' => 'clock-o', 'url' => ['#']],
                    ['label' => Yii::t('main','Announcements'), 'icon' => 'file', 'url' => ['#']],
                    ['label' => Yii::t('main','Auth manager'), 'icon' => 'lock', 'url' => '#', 'items' => [
                        ['label' => Yii::t('main','Auth Assignment'), 'icon' => 'user-plus', 'url' => ['/auth-assignment/index']],
                        ['label' => Yii::t('main','Auth Item'), 'icon' => 'file-text', 'url' => ['/auth-item/index']],
                        ['label' => Yii::t('main','Auth Item Child'), 'icon' => 'sort-amount-desc', 'url' => ['/auth-item-child/index']],
                    ]],
                ],
            ]
        ) ?>

    </section>

</aside>
