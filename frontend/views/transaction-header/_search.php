<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TrHeaderSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tr-header-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'TrHeader_id') ?>

    <?= $form->field($model, 'MsCustomer_id') ?>

    <?= $form->field($model, 'TrHeader_tipe')->widget(Select2::class, [
        'data' => ['Pembelian' => 'Pembelian', 'Penjualan' => 'Penjualan'],
        'options' => ['placeholder' => 'Pilih Tipe Transaksi ...', 'required' => false],
    ]) ?>

    <?php // echo $form->field($model, 'TrHeader_nominal') ?>

    <?php // echo $form->field($model, 'TrHeader_createdIn') ?>

    <?php // echo $form->field($model, 'TrHeader_nama_dibuatOleh') ?>

    <?php // echo $form->field($model, 'TrHeader_nama_menyetujui') ?>

    <?php // echo $form->field($model, 'TrHeader_nama_pemeriksa') ?>

    <?php // echo $form->field($model, 'TrHeader_nama_pengirim') ?>

    <?php // echo $form->field($model, 'TrHeader_nama_penerima') ?>

    <?php // echo $form->field($model, 'TrHeader_filePath_dibuatOleh') ?>

    <?php // echo $form->field($model, 'TrHeader_filePath_menyetujui') ?>

    <?php // echo $form->field($model, 'TrHeader_filePath_pemeriksa') ?>

    <?php // echo $form->field($model, 'TrHeader_filePath_pengirim') ?>

    <?php // echo $form->field($model, 'TrHeader_filePath_penerima') ?>

    <?php // echo $form->field($model, 'TrHeader_createdAt') ?>

    <?php // echo $form->field($model, 'TrHeader_createdBy') ?>

    <?php // echo $form->field($model, 'TrHeader_updatedAt') ?>

    <?php // echo $form->field($model, 'TrHeader_updatedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
