<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MsBarang $model */

$this->title = 'Menambahkan Data Barang';
$this->params['breadcrumbs'][] = ['label' => 'Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-barang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
