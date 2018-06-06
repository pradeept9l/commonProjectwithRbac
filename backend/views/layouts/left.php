<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
       

        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'User', 'icon' => 'user', 'url' => ['/user']],
                    [
                        'label' => 'Brand',
                        'icon' => 'fa fa-cubes',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Add new Brand', 'icon' => 'fa fa-file-code-o', 'url' => ['/brand/create'],],
                            ['label' => 'Brand listing', 'icon' => 'fa fa-dashboard', 'url' => ['/brand/index'],],

                        ],
                    ],
                    [
                        'label' => 'Categories',
                        'icon' => 'fa fa-cubes',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Category listing', 'icon' => 'fa fa-dashboard', 'url' => ['/category/index'],],

                        ],
                    ],
                    [
                        'label' => 'Vehical',
                        'icon' => 'fa fa-cars',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Vehical listing', 'icon' => 'fa fa-dashboard', 'url' => ['/vehical/index'],],

                        ],
                    ],
                    [
                        'label' => 'Colors',
                        'icon' => 'fa fa-cars',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Color listing', 'icon' => 'fa fa-dashboard', 'url' => ['/color/index'],],

                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
