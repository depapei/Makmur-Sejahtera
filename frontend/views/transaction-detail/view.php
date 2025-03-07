<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */

$this->title = $model->TrDetail_id;
$this->params['breadcrumbs'][] = ['label' => 'Tr Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tr-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'TrDetail_id' => $model->TrDetail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'TrDetail_id' => $model->TrDetail_id], [
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
            'TrDetail_id',
            'TrHeader_id',
            'MsBarang_id',
            'TrDetail_qty',
            'TrDetail_hargaSatuan',
            'TrDetail_diskon',
            'TrDetail_createdAt',
            'TrDetail_createdBy',
            'TrDetail_updatedAt',
            'TrDetail_updatedBy',
        ],
    ]) ?>

</div>
