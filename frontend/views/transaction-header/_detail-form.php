<?php

use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tr-detail-form">

    <div class="row">
        <div class="col-lg-12">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        
        <?= $form->field($model, 'MsBarang_id')->widget(Select2::class, [
            'data' => $listBarang,
            'options' => ['placeholder' => 'Pilih Barang ...', 'required' => true],
        ]) ?>

        <?= $form->field($model, 'TrDetail_qty')->textInput(['maxlength' => true, 'placeholder' => 'Jumlah Barang', 'type' => 'number']) ?>
    
        <?= $form->field($model, 'TrDetail_diskon')->textInput(['maxlength' => true, 'placeholder' => '%', 'type' => 'number']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
