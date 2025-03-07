<?php

use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TrHeader $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tr-header-form">

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="row border p-3 my-3 bg-light">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-8">
                    <?= $form->field($model, 'MsCustomer_id')->widget(Select2::class, [
                        'data' => $listCustomer,
                        'options' => ['placeholder' => 'Pilih Customer ...', 'required' => true],
                    ])->label($model->getAttributeLabel('MsCustomer_id') . ' <span class="text-danger">*<span>') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::label('Tidak Ada?') ?>
                        <?= Html::a('Tambahkan', ['customer/create', 'isAddTransaction' => 'true', 'TrHeader_tipe' => $model->TrHeader_tipe], ['class' => 'btn btn-outline-primary w-100']) ?>
                    </div>
                </div>

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
        </div>
        <div class="row border p-3 my-3 bg-light">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 100, // the maximum times, an element can be cloned (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $details[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'MsBarang_id',
                    'TrDetail_qty',
                    'TrDetail_diskon',
                ],
            ]); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list"></i> Items
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items"><!-- widgetContainer -->
                    <?php foreach ($details as $index => $detail): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-items">Items: <?= ($index + 1) ?></span>
                                <button type="button" class="pull-right remove-item btn btn-outline-danger btn-xs"><i class="fa fa-minus"> Remove Item</i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$detail->isNewRecord) {
                                        echo Html::activeHiddenInput($detail, "[{$index}]TrDetail_id");
                                    }
                                ?>

                                <div class="row">
                                    <div class="col">
                                        <?= $form->field($detail, "[{$index}]MsBarang_id")->dropDownList($listBarang, ['placeholder' => 'Pilih Barang ...', 'required' => true, 'class' => 'select-items'])->label('Nama Barang') ?>
                                    </div>
                                    <div class="col">
                                        <?= $form->field($detail, "[{$index}]TrDetail_qty")->textInput(['maxlength' => true, 'placeholder' => 'Jumlah Barang', 'type' => 'number']) ?>
                                    </div>
                                    <div class="col">
                                        <?= $form->field($detail, "[{$index}]TrDetail_diskon")->textInput(['maxlength' => true])->textInput(['maxlength' => true, 'placeholder' => '%', 'type' => 'number']) ?>
                                    </div>
                                </div><!-- end:row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="button" class="add-item btn btn-outline-primary btn-xs"><i class="fa fa-plus"></i> Add Items</button>
            <?php DynamicFormWidget::end(); ?>
        </div>
        
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>

</div>