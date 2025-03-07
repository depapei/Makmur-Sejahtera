<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrHeader $model */

$this->title = $model->TrHeader_tipe . ' ' . date('d F Y', strtotime($model->TrHeader_tanggal));
$this->params['breadcrumbs'][] = ['label' => 'List Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'TrHeader_id' => $model->TrHeader_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="tr-header-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listCustomer' => $listCustomer,
    ]) ?>

</div>
