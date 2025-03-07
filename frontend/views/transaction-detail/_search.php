<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TrDetailSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tr-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'TrDetail_id') ?>

    <?= $form->field($model, 'TrHeader_id') ?>

    <?= $form->field($model, 'MsBarang_id') ?>

    <?= $form->field($model, 'TrDetail_qty') ?>

    <?= $form->field($model, 'TrDetail_hargaSatuan') ?>

    <?php // echo $form->field($model, 'TrDetail_diskon') ?>

    <?php // echo $form->field($model, 'TrDetail_createdAt') ?>

    <?php // echo $form->field($model, 'TrDetail_createdBy') ?>

    <?php // echo $form->field($model, 'TrDetail_updatedAt') ?>

    <?php // echo $form->field($model, 'TrDetail_updatedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
