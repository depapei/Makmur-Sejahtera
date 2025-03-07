<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */

$this->title = $model->trHeader->TrHeader_tipe . ' ' . date('d F Y', strtotime($model->trHeader->TrHeader_tanggal));
$this->params['breadcrumbs'][] = ['label' => 'List Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'TrHeader_id' => $model->TrHeader_id]];
$this->params['breadcrumbs'][] = $model->msBarang->MsBarang_nama;
\yii\web\YiiAsset::register($this);
?>
<div class="tr-detail-view">

    <h2><?= $model->msBarang->MsBarang_nama ?></h2>

    <p>
        <?= Html::a('Edit', ['detail-update', 'TrDetail_id' => $model->TrDetail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['detail-delete', 'TrDetail_id' => $model->TrDetail_id], [
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
            // 'TrDetail_id',
            // 'TrHeader_id',
            // 'MsBarang_id',
            'msBarang.MsBarang_nama',
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
            'TrDetail_createdAt',
            'TrDetail_createdBy',
            'TrDetail_updatedAt',
            'TrDetail_updatedBy',
            'TrDetail_keterangan:ntext',
        ],
    ]) ?>

</div>
