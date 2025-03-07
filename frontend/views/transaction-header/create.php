<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrHeader $model */

$this->title = 'Menambahkan Data Transaksi';
$this->params['breadcrumbs'][] = ['label' => 'List Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listCustomer' => $listCustomer,
    ]) ?>

</div>
