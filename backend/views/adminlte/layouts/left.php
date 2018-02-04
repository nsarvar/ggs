<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Davron Raximov</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
//                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/gii']],
                    ['label' => 'Students', 'icon' => 'users', 'url' => ['/debug']],
                    ['label' => 'Teachers', 'icon' => 'user-secret', 'url' => ['/debug']],
                    ['label' => 'Finance', 'icon' => 'money', 'url' => ['/debug']],
                    ['label' => 'Courses', 'icon' => 'list-alt', 'url' => ['/debug']],
                    ['label' => 'Time table', 'icon' => 'clock-o', 'url' => ['/debug']],
                    ['label' => 'Announcements', 'icon' => 'file', 'url' => ['/debug']],
                    ['label' => 'Auth manager', 'icon' => 'lock', 'url' => '#', 'items' => [
                        ['label' => 'Auth Assignment', 'icon' => 'file', 'url' => ['/auth-assignment/index']],
                        ['label' => 'Auth Role', 'icon' => 'file', 'url' => ['/auth-role/index']],
                        ['label' => 'Auth Item', 'icon' => 'file', 'url' => ['/auth-item/index']],
                        ['label' => 'Auth Rule', 'icon' => 'file', 'url' => ['/auth-rule/index']],
                    ]],
                ],
            ]
        ) ?>

    </section>

</aside>
