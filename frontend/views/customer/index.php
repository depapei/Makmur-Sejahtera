<?php

use app\models\MsCustomer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\MsCustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'List Customer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambahkan Data Customer Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'MsCustomer_id',
            'MsCustomer_nama',
            'MsCustomer_toko',
            [
                'attribute' => 'MsCustomer_hutang',
                'format' => ['currency', 'RP.'],
            ],
            [
                'attribute' => 'MsCustomer_piutang',
                'format' => ['currency', 'RP.'],
            ],
            'MsCustomer_nomorHp',
            'MsCustomer_email:email',
            'MsCustomer_alamat:ntext',
            //'MsCustomer_createdAt',
            //'MsCustomer_createdBy',
            //'MsCustomer_updatedAt',
            //'MsCustomer_updatedBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MsCustomer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'MsCustomer_id' => $model->MsCustomer_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
