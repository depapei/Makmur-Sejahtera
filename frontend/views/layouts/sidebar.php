<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home() ?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">MAKMUR SEJAHTERA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info"></span>',
                        'url' => 'site/dashboard',
                    ],
                    ['label' => 'Menu', 'header' => true],
                    [
                        'label' => 'Transaksi',
                        'items' => [
                            ['label' => 'List Transaksi', 'iconStyle' => 'far', 'url' => ['transaction-header/index']],
                            ['label' => 'Tambah Transaksi Baru', 'iconStyle' => 'far', 'url' => ['transaction-header/create']],
                        ]
                    ],
                    [
                        'label' => 'Gudang',
                        'items' => [
                            ['label' => 'List Barang', 'iconStyle' => 'far', 'url' => ['barang/index']],
                            ['label' => 'Tambah Barang Baru', 'iconStyle' => 'far', 'url' => ['barang/create']],
                        ]
                    ],
                    [
                        'label' => 'Customer',
                        'items' => [
                            ['label' => 'List Customer', 'iconStyle' => 'far', 'url' => ['customer/index']],
                            ['label' => 'Tambah Customer Baru', 'iconStyle' => 'far', 'url' => ['customer/create']],
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>