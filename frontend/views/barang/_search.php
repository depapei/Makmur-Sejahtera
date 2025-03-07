<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MsBarangSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ms-barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row my-3">
        
    
        <div class="col-3">
            <?= $form->field($model, 'MsBarang_nama') ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'MsBarang_hargaBeli') ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'MsBarang_stok') ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'MsBarang_kategori') ?>
        </div>

        <?php // echo $form->field($model, 'MsBarang_keterangan') ?>
    
        <?php // echo $form->field($model, 'MsBarang_createdAt') ?>
    
        <?php // echo $form->field($model, 'MsBarang_createdBy') ?>
    
        <?php // echo $form->field($model, 'MsBarang_updatedAt') ?>
    
        <?php // echo $form->field($model, 'MsBarang_updatedBy') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Cari Barang', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>

</div>
