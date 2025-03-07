<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MsBarang $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ms-barang-form">

    <div class="row">
        <div class="col-lg">
            <?php $form = ActiveForm::begin(); ?>
        
            <?= $form->field($model, 'MsBarang_nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama Barang']) ?>
        
            <?= $form->field($model, 'MsBarang_hargaBeli')->textInput(['maxlength' => true, 'placeholder' => 'Beli ...', 'type' => 'number']) ?>

            <?= $form->field($model, 'MsBarang_hargaJual')->textInput(['maxlength' => true, 'placeholder' => 'Jual dengan Harga ...', 'type' => 'number']) ?>
        
            <?= $form->field($model, 'MsBarang_stok')->textInput(['placeholder' => 'Jumlah Stok', 'type' => 'number']) ?>
        
            <?= $form->field($model, 'MsBarang_kategori')->widget(Select2::class, [
                    'data' => ['Makanan' => 'Makanan', 'Minuman' => 'Minuman', 'Bahan Baku' => 'Bahan Baku', 'Lainnya' => 'Lainnya'],
                    'options' => ['placeholder' => 'Pilih Kategori ...', 'required' => true],
                ]) ?>
        
            <?= $form->field($model, 'MsBarang_keterangan')->textarea(['rows' => 6, 'placeholder' => 'keterangan (Opsional)']) ?>
        
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
