<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tr-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TrHeader_id')->textInput() ?>

    <?= $form->field($model, 'MsBarang_id')->textInput() ?>

    <?= $form->field($model, 'TrDetail_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TrDetail_hargaSatuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TrDetail_diskon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TrDetail_createdAt')->textInput() ?>

    <?= $form->field($model, 'TrDetail_createdBy')->textInput() ?>

    <?= $form->field($model, 'TrDetail_updatedAt')->textInput() ?>

    <?= $form->field($model, 'TrDetail_updatedBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
