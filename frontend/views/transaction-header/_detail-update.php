<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */

$this->title = $model->trHeader->TrHeader_tipe . ' ' . date('d F Y', strtotime($model->trHeader->TrHeader_tanggal));
$this->params['breadcrumbs'][] = ['label' => 'List Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'TrHeader_id' => $model->TrHeader_id]];
$this->params['breadcrumbs'][] = ['label' => $model->msBarang->MsBarang_nama, 'url' => ['detail-view', 'TrDetail_id' => $model->TrDetail_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="tr-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_detail-form', [
        'model' => $model,
        'listBarang' => $listBarang,
    ]) ?>

</div>
