<?php

use app\models\TrDetail;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TrDetailSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tr Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tr Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TrDetail_id',
            'TrHeader_id',
            'MsBarang_id',
            'TrDetail_qty',
            [
                'attribute' => 'TrDetail_jumlahHarga',
                'format' => ['currency', 'IDR']
            ],
            //'TrDetail_diskon',
            //'TrDetail_createdAt',
            //'TrDetail_createdBy',
            //'TrDetail_updatedAt',
            //'TrDetail_updatedBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TrDetail $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'TrDetail_id' => $model->TrDetail_id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
