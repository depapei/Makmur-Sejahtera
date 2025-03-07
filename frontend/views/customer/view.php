<?php

use app\models\TrDetail;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\MsCustomer $model */

$this->title = $model->MsCustomer_nama;
$this->params['breadcrumbs'][] = ['label' => 'List Customer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ms-customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'MsCustomer_id' => $model->MsCustomer_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'MsCustomer_id' => $model->MsCustomer_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-12">
        <h3>Data Pelanggan</h3>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'MsCustomer_id',
                    'MsCustomer_nama',
                    'MsCustomer_toko',
                    [
                        'attribute' => 'MsCustomer_hutang',
                        'format' => ['currency', 'RP.'],
                    ],
                    [
                        'attribute' => 'MsCustomer_piutang',
                        'format' => ['currency', 'RP.'],
                    ],
                    'MsCustomer_nomorHp',
                    'MsCustomer_email:email',
                    'MsCustomer_alamat:ntext',
                    // 'MsCustomer_createdAt',
                    // 'MsCustomer_createdBy',
                    // 'MsCustomer_updatedAt',
                    // 'MsCustomer_updatedBy',
                ],
            ]) ?>
        </div>
        <div class="col-12">
            <h3>Riwayat Transaksi</h3>
            <p>
                <?= Html::a('Tambahkan Transaksi Baru', ['new-transaction', 'MsCustomer_id' => $model->MsCustomer_id], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $transactionDataProvider,
                // 'filterModel' => $transactionSearchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'trHeader.TrHeader_tanggal',
                        'format' => ['date', 'd MMMM Y']
                    ],[
                        'label' => 'Transaksi',
                        'value' => function ($model){
                            switch ($model->trHeader->TrHeader_tipe){
                                case 'Pembelian':
                                    return '<span class="text-danger">' . $model->trHeader->TrHeader_tipe . ' (+)</span>';
                                case 'Penjualan':
                                    return '<span class="text-success">' . $model->trHeader->TrHeader_tipe . ' (-)</span>';
                            };
                        },
                        'format' => 'raw',
                    ],
                    'msBarang.MsBarang_nama',
                    'TrDetail_qty',
                    [
                        'attribute' => 'TrDetail_jumlahHarga',
                        'format' => ['currency', 'RP.']
                    ],
                    [
                        'label' => 'Status Pembayaran',
                        'value' => function ($model){
                            switch ($model->trHeader->TrHeader_paymentStatus){
                                case '1':
                                    return '<span class="text-success">Lunas</span>';
                                case '0':
                                    return '<span class="text-danger">Belum Lunas</span>';
                            };
                        },
                        'format' => 'raw',
                    ],
                    //'TrDetail_diskon',
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
        </div>
    </div>

</div>
