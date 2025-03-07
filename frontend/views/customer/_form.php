<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MsCustomer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ms-customer-form">
    <div class="row">
        <div class="col-lg">
            <?php $form = ActiveForm::begin(); ?>
        
            <?= $form->field($model, 'MsCustomer_nama')->textInput(['maxlength' => true, 'placeholder' => 'Mandatory'])->label($model->getAttributeLabel('MsCustomer_nama') . ' <span class="text-danger">*<span>') ?>
        
            <?= $form->field($model, 'MsCustomer_toko')->textInput(['maxlength' => true, 'placeholder' => 'Toko Customer (Opsional)']) ?>
        
            <?= $form->field($model, 'MsCustomer_nomorHp')->textInput(['maxlength' => true, 'placeholder' => 'Nomor Handphone Customer (Opsional)']) ?>
        
            <?= $form->field($model, 'MsCustomer_email')->textInput(['maxlength' => true, 'placeholder' => 'Email Customer (Opsional)']) ?>
        
            <?= $form->field($model, 'MsCustomer_alamat')->textarea(['rows' => 6, 'placeholder' => 'Alamat Customer (Opsional)']) ?>
            
        </div>
        <div class="col-lg">
            <?= $form->field($model, 'MsCustomer_hutang')->textInput(['maxlength' => true, 'placeholder' => 'Jumlah Hutang Customer (Opsional)', 'type' => 'number']) ?>

            <?= $form->field($model, 'MsCustomer_piutang')->textInput(['maxlength' => true, 'placeholder' => 'Jumlah Piutang Customer (Opsional)', 'type' => 'number']) ?>

        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        </div>  
    </div>

</div>
