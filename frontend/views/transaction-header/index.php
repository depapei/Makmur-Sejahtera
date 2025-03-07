<?php

use app\models\TrHeader;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TrHeaderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'List Transaksi';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css");
$this->registerJsFile("https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile("https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="tr-header-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambahkan Transaksi Baru', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Tambahkan Penjualan', ['create-multiple-detail', 'TrHeader_tipe' => 'Penjualan'], ['class' => 'btn btn-outline-success']) ?>
        <?= Html::a('Tambahkan Pembelian', ['create-multiple-detail', 'TrHeader_tipe' => 'Pembelian'], ['class' => 'btn btn-outline-danger']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['id' => 'requestTable', 'class' => 'table table-striped table-bordered'], // Menambahkan ID dan kelas Bootstrap
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'TrHeader_id',
            'msCustomer.MsCustomer_nama',
            [
                'label' => 'Transaksi',
                'value' => function ($model){
                    switch ($model->TrHeader_tipe){
                        case 'Pembelian':
                            return '<span class="text-danger">' . $model->TrHeader_tipe . ' (+)</span>';
                        case 'Penjualan':
                            return '<span class="text-success">' . $model->TrHeader_tipe . ' (-)</span>';
                    };
                },
                'format' => 'raw',
            ],
            'TrHeader_judul',
            [
                'attribute' => 'TrHeader_tanggal',
                'format' => ['date', 'd MMM Y']
            ],
            [
                'label' => 'Status Pembayaran',
                'value' => function ($model){
                    switch ($model->TrHeader_paymentStatus){
                        case '1':
                            return '<span class="text-success">Sudah Lunas</span>';
                        case '0':
                            return '<span class="text-danger">Belum Lunas</span>';
                    };
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Total',
                'value' => function ($model){
                    $total = 0;
                    $jumlahItems = 0;
                    foreach ($model->trDetails as $detail)
                    {
                        $total += $detail->TrDetail_jumlahHarga;
                    }
                    $jumlahItems = count($model->trDetails);
                    return $total;
                },
                'format' => ['currency', 'IDR']
            ],
            [
                'label' => 'Jumlah Item',
                'value' => function ($model){
                    $jumlahItems = 0;
                    $jumlahItems = count($model->trDetails);
                    return $jumlahItems;
                },
                'options' => ['width' => '5px']
            ],
            // 'TrHeader_nominal',
            // 'TrHeader_createdIn',
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
            // 'TrHeader_createdAt',
            // 'TrHeader_createdBy',
            // 'TrHeader_updatedAt',
            // 'TrHeader_updatedBy',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, TrHeader $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'TrHeader_id' => $model->TrHeader_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
