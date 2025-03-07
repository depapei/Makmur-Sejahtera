<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MsCustomer $model */

$this->title = 'Menambahkan Data Customer';
$this->params['breadcrumbs'][] = ['label' => 'List Customer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
