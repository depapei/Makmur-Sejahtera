<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MsBarang $model */

$this->title = 'Edit Barang: ' . $model->MsBarang_nama;
$this->params['breadcrumbs'][] = ['label' => 'Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MsBarang_nama, 'url' => ['view', 'MsBarang_id' => $model->MsBarang_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="ms-barang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
