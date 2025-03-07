<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */

$this->title = 'Update Tr Detail: ' . $model->TrDetail_id;
$this->params['breadcrumbs'][] = ['label' => 'Tr Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TrDetail_id, 'url' => ['view', 'TrDetail_id' => $model->TrDetail_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tr-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
