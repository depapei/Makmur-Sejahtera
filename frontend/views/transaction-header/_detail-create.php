<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */
$this->title = $model->trHeader->TrHeader_tipe . ' ' . date('d F Y', strtotime($model->trHeader->TrHeader_tanggal));
$this->params['breadcrumbs'][] = ['label' => 'List Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'TrHeader_id' => $model->TrHeader_id]];
$this->params['breadcrumbs'][] = 'Menambahkan Item Transaksi';
?>
<div class="tr-detail-create">

    <h1><?= Html::encode('Tambahkan Item Transaksi') ?></h1>

    <?= $this->render('_detail-form', [
        'model' => $model,
        'listBarang' => $listBarang,
    ]) ?>

</div>
