<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TrHeader $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tr-header-form">

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row border p-3 my-3 bg-light">
            <div class="col-sm-6">
                <?= $form->field($model, 'MsCustomer_id')->widget(Select2::class, [
                    'data' => $listCustomer,
                    'options' => ['placeholder' => 'Pilih Customer ...', 'required' => true],
                ])->label($model->getAttributeLabel('MsCustomer_id') . ' <span class="text-danger">*<span>') ?>

                <?= $model->TrHeader_tipe ? '' : $form->field($model, 'TrHeader_tipe')->radiolist(['Pembelian' => 'Pembelian', 'Penjualan' => 'Penjualan'],['maxlength' => true, 'placeholder' => 'Tipe Transaksi (Opsional)', 'required' => true, 'value' => $model->TrHeader_tipe ? $model->TrHeader_tipe : 'Penjualan', 'readonly' => $model->TrHeader_tipe ? true : false])->label($model->getAttributeLabel('TrHeader_tipe') . ' <span class="text-danger">*<span>') ?>

                <?= $form->field($model, 'TrHeader_tanggal')->textInput(['placeholder' => 'Masukan Tanggal', 'type' => 'date'])->label($model->getAttributeLabel('TrHeader_tanggal') . ' <span class="text-danger">*<span>') ?>

                <?= $form->field($model, 'TrHeader_paymentStatus')->radiolist([
                    true => 'Lunas', false => 'Belum Lunas'
                    ],
                    [
                    'maxlength' => true, 
                    'placeholder' => 'Tipe Transaksi (Opsional)', 
                    'required' => true, 
                    'value' => true,
                ])->label($model->getAttributeLabel('TrHeader_paymentStatus') . ' <span class="text-danger">*<span>')?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'TrHeader_judul')->textInput(['maxlength' => true, 'placeholder' => 'Contoh: Faktur Penjualan / Pembelian Kredit'])->label($model->getAttributeLabel('TrHeader_judul') . ' <span class="text-danger">*<span>') ?>

                <?= $form->field($model, 'TrHeader_createdIn')->textInput(['maxlength' => true, 'placeholder' => 'Contoh: Papua (Opsional)']) ?>

                <?= $form->field($model, 'TrHeader_keterangan')->textarea(['rows' => 6, 'placeholder' => 'Keterangan (Opsional)']) ?>
            </div>
            <!-- <div class="col-lg">
        
                <?= $form->field($model, 'TrHeader_nama_dibuatOleh')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_nama_menyetujui')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_nama_pemeriksa')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_nama_pengirim')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_nama_penerima')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_filePath_dibuatOleh')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_filePath_menyetujui')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_filePath_pemeriksa')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_filePath_pengirim')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'TrHeader_filePath_penerima')->textInput(['maxlength' => true]) ?>

            </div> -->
        </div>
        
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php
            if ($model->isNewRecord){
                echo Html::a('Ingin sekalian menambahkan barang?', ['transaction-header/create-multiple-detail', 'MsCustomer_id' => $model->MsCustomer_id], ['class' => 'btn btn-outline-primary']) ;
            }
            ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>

</div>
