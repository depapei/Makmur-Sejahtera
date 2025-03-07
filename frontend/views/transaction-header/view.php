<?php

use app\models\TrDetail;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\TrHeader $model */

$this->title = $model->TrHeader_tipe . ' ' . date('d F Y', strtotime($model->TrHeader_tanggal));
$this->params['breadcrumbs'][] = ['label' => 'List Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCssFile("https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css");
$this->registerJsFile("https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile("https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="tr-header-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'TrHeader_id' => $model->TrHeader_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'TrHeader_id' => $model->TrHeader_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nama Customer',
                'value' => function($model){
                    return $model->msCustomer->MsCustomer_nama . Html::a('Lihat detail', ['customer/view', 'MsCustomer_id' => $model->msCustomer->MsCustomer_id], ['class' => 'btn-sm my-3']);
                },
                'format' => 'raw',
            ],
            'TrHeader_tipe',
            'TrHeader_judul',
            [
                'attribute' => 'TrHeader_tanggal',
                'format' => ['date', 'd MMMM yyyy']
            ],
            [
                'format' => ['currency', 'RP.'],
                'label' => 'Nominal',
                'value' => function ($model){
                    $nominal = 0;
                    foreach ($model->trDetails as $nominalPerDetail){
                        $nominal += $nominalPerDetail->TrDetail_jumlahHarga;
                    };
                    return $nominal;
                },
            ],
            [
                'label' => 'Status Pembayaran',
                'value' => function ($model){
                    switch ($model->TrHeader_paymentStatus){
                        case '1':
                            return '<span class="text-success">Lunas</span>';
                        case '0':
                            return '<span class="text-danger">Belum Lunas</span>' . Html::a('Sudah lunas? Click saya!', ['transaction-header/pelunasan', 'TrHeader_id' => $model->TrHeader_id], ['class' => 'btn-sm my-3']);
                    };
                },
                'format' => 'raw',
            ],
            'TrHeader_createdIn',
            // 'TrHeader_nama_dibuatOleh',
            // 'TrHeader_nama_menyetujui',
            // 'TrHeader_nama_pemeriksa',
            // 'TrHeader_nama_pengirim',
            // 'TrHeader_nama_penerima',
            // 'TrHeader_filePath_dibuatOleh',
            // 'TrHeader_filePath_menyetujui',
            // 'TrHeader_filePath_pemeriksa',
            // 'TrHeader_filePath_pengirim',
            // 'TrHeader_filePath_penerima',
            'TrHeader_createdAt',
            // 'TrHeader_createdBy',
            // 'TrHeader_updatedAt',
            // 'TrHeader_updatedBy',
        ],
    ]) ?>

    <p>
        <?= Html::a('Tambahkan Barang', ['detail-create', 'trHeader_id' => $model->TrHeader_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $detailDataProvider,
        'tableOptions' => ['id' => 'requestTable', 'class' => 'table table-striped table-bordered'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'msBarang.MsBarang_nama',
            // [
            //     'label' => 'Sisa Stok di Gudang',
            //     'attribute' => 'msBarang.MsBarang_stok',
            // ],
            [
                'label' => 'Harga (Sebelum Diskon)',
                'value' => function ($model){
                    if ($model->trHeader->TrHeader_tipe === 'Penjualan')
                    {
                        return $model->msBarang->MsBarang_hargaJual;
                    } 
                    else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
                    {
                        return $model->msBarang->MsBarang_hargaBeli;
                    }
                },
                'format' => ['currency', 'Rp.']
            ],
            [
                'label' => 'Diskon',
                'value' => function ($model){
                    if ($model->TrDetail_diskon == 0) {
                        return 'Tidak ada';
                    }
                    return $model->TrDetail_diskon . '%';
                },
            ],
            [
                'label' => 'Harga (Diskon)',
                'value' => function ($model){
                    if (!$model->TrDetail_diskon) {
                        if ($model->trHeader->TrHeader_tipe === 'Penjualan')
                        {
                            return $model->msBarang->MsBarang_hargaJual;
                        } 
                        else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
                        {
                            return $model->msBarang->MsBarang_hargaBeli;
                        }
                    }
                    else {
                        if ($model->trHeader->TrHeader_tipe === 'Penjualan')
                        {
                            return $model->msBarang->MsBarang_hargaJual - ($model->msBarang->MsBarang_hargaJual / 100) * $model->TrDetail_diskon;
                        } 
                        else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
                        {
                            return $model->msBarang->MsBarang_hargaBeli - ($model->msBarang->MsBarang_hargaBeli / 100) * $model->TrDetail_diskon;
                        }
                    }
                },
                'format' => ['currency', 'Rp.']
            ],
            'TrDetail_qty',
            [
                'attribute' => 'TrDetail_jumlahHarga',
                'format' => ['currency', 'Rp.']
            ],
            //'TrDetail_createdAt',
            //'TrDetail_createdBy',
            //'TrDetail_updatedAt',
            //'TrDetail_updatedBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TrDetail $model, $key, $index, $column) {
                    // Ganti 'detailView' dan 'detailUpdate' sesuai dengan nama action yang diinginkan
                    switch ($action) {
                        case 'view':
                            return Url::toRoute(['transaction-header/detail-view', 'TrDetail_id' => $model->TrDetail_id]);
                        case 'update':
                            return Url::toRoute(['transaction-header/detail-update', 'TrDetail_id' => $model->TrDetail_id]);
                        case 'delete':
                            return Url::toRoute(['transaction-header/detail-delete', 'TrDetail_id' => $model->TrDetail_id]);
                        default:
                            return Url::toRoute([$action, 'TrDetail_id' => $model->TrDetail_id]);
                    }
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
