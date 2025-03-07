<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\MsBarang $model */

$this->title = $model->MsBarang_nama;
$this->params['breadcrumbs'][] = ['label' => 'Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ms-barang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'MsBarang_id' => $model->MsBarang_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'MsBarang_id' => $model->MsBarang_id], [
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
            // 'MsBarang_id',
            'MsBarang_nama',
            [
                'attribute' => 'MsBarang_hargaBeli',
                'format' => ['currency', 'RP.'],
            ],
            [
                'attribute' => 'MsBarang_hargaJual',
                'format' => ['currency', 'RP.'],
            ],
            'MsBarang_stok',
            'MsBarang_kategori',
            'MsBarang_keterangan:ntext',
            'MsBarang_createdAt',
            'MsBarang_createdBy',
            'MsBarang_updatedAt',
            'MsBarang_updatedBy',
        ],
    ]) ?>

</div>
