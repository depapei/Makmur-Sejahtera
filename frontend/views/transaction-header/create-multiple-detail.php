<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrHeader $model */

$this->title = $model->TrHeader_tipe ? 'Menambahkan Data Transaksi (' . $model->TrHeader_tipe . ')' : '' . 'Menambahkan Data Transaksi (Beta Test)';
$this->params['breadcrumbs'][] = ['label' => 'List Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-multiple-detail', [
        'model' => $model,
        'listCustomer' => $listCustomer,
        'listBarang' => $listBarang,
        'details' => $details,
    ]) ?>

</div>
