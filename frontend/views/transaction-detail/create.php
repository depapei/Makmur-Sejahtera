<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrDetail $model */

$this->title = 'Create Tr Detail';
$this->params['breadcrumbs'][] = ['label' => 'Tr Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
