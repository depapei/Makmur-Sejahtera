<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MsCustomer $model */

$this->title = 'Edit Customer: ' . $model->MsCustomer_nama;
$this->params['breadcrumbs'][] = ['label' => 'List Customer', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MsCustomer_nama, 'url' => ['view', 'MsCustomer_id' => $model->MsCustomer_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="ms-customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
