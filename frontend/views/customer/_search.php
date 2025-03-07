<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MsCustomerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ms-customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'MsCustomer_id') ?>

    <?= $form->field($model, 'MsCustomer_nama') ?>

    <?= $form->field($model, 'MsCustomer_toko') ?>

    <?= $form->field($model, 'MsCustomer_hutang') ?>

    <?= $form->field($model, 'MsCustomer_nomorHp') ?>

    <?php // echo $form->field($model, 'MsCustomer_email') ?>

    <?php // echo $form->field($model, 'MsCustomer_alamat') ?>

    <?php // echo $form->field($model, 'MsCustomer_createdAt') ?>

    <?php // echo $form->field($model, 'MsCustomer_createdBy') ?>

    <?php // echo $form->field($model, 'MsCustomer_updatedAt') ?>

    <?php // echo $form->field($model, 'MsCustomer_updatedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
