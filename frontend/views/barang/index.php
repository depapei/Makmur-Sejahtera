<?php

use app\models\MsBarang;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\MsBarangSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gudang';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css");
$this->registerJsFile("https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile("https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<!-- on your view layout file HEAD section -->
<div class="ms-barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambahkan Barang Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'tableOptions' => ['id' => 'requestTable', 'class' => 'table table-striped table-bordered'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'MsBarang_id',
            [
                'attribute' => 'MsBarang_nama',
            ],
            [
                'attribute' => 'MsBarang_hargaBeli',
                'format' => ['currency', 'RP.'],
            ],
            [
                'attribute' => 'MsBarang_hargaJual',
                'format' => ['currency', 'RP.'],
            ],
            'MsBarang_stok',
            'MsBarang_kategori',
            // 'MsBarang_keterangan:ntext',
            //'MsBarang_createdAt',
            //'MsBarang_createdBy',
            //'MsBarang_updatedAt',
            //'MsBarang_updatedBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MsBarang $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'MsBarang_id' => $model->MsBarang_id]);
                },
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
