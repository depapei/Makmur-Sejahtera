<?php

namespace frontend\controllers;

use app\models\MsBarang;
use app\models\MsCustomer;
use app\models\TrDetail;
use app\models\TrDetailSearch;
use app\models\TrHeader;
use app\models\TrHeaderSearch;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TransactionHeaderController implements the CRUD actions for TrHeader model.
 */
class TransactionHeaderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TrHeader models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TrHeaderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrHeader model.
     * @param int $TrHeader_id Tr Header ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TrHeader_id)
    {
        $detailSearchModel = new TrDetailSearch();
        $detailSearchModel->TrHeader_id = $TrHeader_id;
        $detailDataProvider = $detailSearchModel->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($TrHeader_id),
            'detailSearchModel' => $detailSearchModel,
            'detailDataProvider' => $detailDataProvider,
        ]);
    }

    /**
     * Creates a new TrHeader model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($MsCustomer_id = null)
    {
        $model = new TrHeader();
        $listCustomer = MsCustomer::getAllCustomer();
        $model->MsCustomer_id = $MsCustomer_id ? $MsCustomer_id : null;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'TrHeader_id' => $model->TrHeader_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listCustomer' => $listCustomer,
        ]);
    }

    public function actionCreateMultipleDetail($MsCustomer_id = null, $TrHeader_tipe = null)
    {
        $model = new TrHeader();
        $TrHeader_tipe ? $model->TrHeader_tipe = $TrHeader_tipe : null;
        $details = [new TrDetail];
        $listCustomer = MsCustomer::getAllCustomer();
        $listBarang = MsBarang::getAllBarang();
        $model->MsCustomer_id = $MsCustomer_id ? $MsCustomer_id : null;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $details = TrDetail::createMultiple(TrDetail::classname());
            TrDetail::loadMultiple($details, Yii::$app->request->post());

            $valid = $model->validate();
            $valid = TrDetail::validateMultiple($details) && $valid;

            try {
                if ($flag = $model->save(false)) {
                    foreach ($details as $detail) {
                        $detail->TrHeader_id = $model->TrHeader_id;
                        TrDetail::manipulateTransactions($detail);
                        if (! ($flag = $detail->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
                if ($flag) {
                    TrDetail::manipulateHutang($details,$model->MsCustomer_id);
                    $transaction->commit();
                    return $this->redirect(['view', 'TrHeader_id' => $model->TrHeader_id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        } else {
            $model->loadDefaultValues();
        }
        
        if ($TrHeader_tipe && $TrHeader_tipe === 'Pembelian') {
            return $this->render('create-multiple-detail', [
                'model' => $model,
                'details' => $details,
                'listCustomer' => $listCustomer,
                'listBarang' => $listBarang,
            ]);
        } else if ($TrHeader_tipe && $TrHeader_tipe === 'Penjualan') {
            $listBarang = MsBarang::getAllBarang($model->TrHeader_tipe);
            return $this->render('create-multiple-detail', [
                'model' => $model,
                'details' => $details,
                'listCustomer' => $listCustomer,
                'listBarang' => $listBarang,
            ]);
        }

        return $this->render('create-multiple-detail', [
            'model' => $model,
            'details' => $details,
            'listCustomer' => $listCustomer,
            'listBarang' => $listBarang,
        ]);
    }

    /**
     * Updates an existing TrHeader model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TrHeader_id Tr Header ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TrHeader_id)
    {
        $model = $this->findModel($TrHeader_id);
        $listCustomer = MsCustomer::getAllCustomer();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TrHeader_id' => $model->TrHeader_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listCustomer' => $listCustomer,
        ]);
    }

    /**
     * Deletes an existing TrHeader model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrHeader_id Tr Header ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TrHeader_id)
    {
        $this->findModel($TrHeader_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrHeader model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $TrHeader_id Tr Header ID
     * @return TrHeader the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TrHeader_id)
    {
        if (($model = TrHeader::findOne(['TrHeader_id' => $TrHeader_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetailView($TrDetail_id)
    {
        return $this->render('_detail-view', [
            'model' => $this->findDetail($TrDetail_id),
        ]);
    }

    /**
     * Creates a new TrDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionDetailCreate($trHeader_id)
    {
        $model = new TrDetail();
        $listBarang = MsBarang::getAllBarang();
        $model->TrHeader_id = $trHeader_id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $barang = MsBarang::getBarang($model->MsBarang_id);

                // Memanipulasi Stok
                if ($model->trHeader->TrHeader_tipe === 'Penjualan')
                {
                    $harga = $barang->MsBarang_hargaJual;
                    if ($model->msBarang->MsBarang_stok < $model->TrDetail_qty || $barang->MsBarang_stok === 0){
                        Yii::$app->session->setFlash('error', 'Stok tidak mencukupi! <strong>"'.$model->msBarang->MsBarang_nama.'"</strong> Stok yang tersedia = '.$model->msBarang->MsBarang_stok);
                        return $this->redirect(['detail-create', 'trHeader_id' => $model->TrHeader_id]);
                    } else {
                        $barang->MsBarang_stok = $barang->MsBarang_stok - $model->TrDetail_qty;
                    }
                } 
                else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
                {
                    $harga = $barang->MsBarang_hargaBeli;
                    $barang->MsBarang_stok = $barang->MsBarang_stok + $model->TrDetail_qty;
                }

                // Mengatur Diskon
                if ($model->TrDetail_diskon)
                {
                    $diskon = $model->TrDetail_diskon / 100;
                    $model->TrDetail_jumlahHarga = $harga - $diskon * $harga;
                    $model->TrDetail_jumlahHarga = $model->TrDetail_jumlahHarga * $model->TrDetail_qty;

                }
                else {
                    $model->TrDetail_diskon = 0;
                    $model->TrDetail_jumlahHarga = $model->TrDetail_qty * $harga;
                }

                // Mengatur Hutang / Piutang
                $customer = MsCustomer::getCustomer($model->trHeader->MsCustomer_id);
                if ($model->trHeader->TrHeader_tipe === 'Penjualan')
                {
                    if (!$model->trHeader->TrHeader_paymentStatus)
                    {
                        $customer->MsCustomer_hutang =+ $model->TrDetail_jumlahHarga;
                    }
                } 
                else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
                {
                    if (!$model->trHeader->TrHeader_paymentStatus)
                    {
                        $customer->MsCustomer_piutang =+ $model->TrDetail_jumlahHarga;
                    }
                }

                if ($model->save() && $barang->save() && $customer->save())
                {
                    return $this->redirect(['view', 'TrHeader_id' => $model->TrHeader_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('_detail-create', [
            'model' => $model,
            'listBarang' => $listBarang,
        ]);
    }

    /**
     * Updates an existing TrDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TrDetail_id Tr Detail ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetailUpdate($TrDetail_id)
    {
        $model = $this->findDetail($TrDetail_id);
        $qtyAwal = $model->TrDetail_qty;
        $listBarang = MsBarang::getAllBarang();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $barang = MsBarang::getBarang($model->MsBarang_id);
                // Memanipulasi Stok
                if ($model->trHeader->TrHeader_tipe === 'Penjualan')
                {
                    $harga = $barang->MsBarang_hargaJual;
                    $sisaStok = $model->msBarang->MsBarang_stok + $qtyAwal;
                    if ($sisaStok < $model->TrDetail_qty || $sisaStok <= 0){
                        Yii::$app->session->setFlash('error', 'Stok tidak mencukupi! <strong>"'.$model->msBarang->MsBarang_nama.'"</strong> Stok yang tersedia = '.$model->msBarang->MsBarang_stok);
                        return $this->redirect(['detail-update', 'TrDetail_id' => $model->TrDetail_id]);
                    } else {
                        $barang->MsBarang_stok = $sisaStok - $model->TrDetail_qty;
                    }
                } 
                else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
                {
                    $harga = $barang->MsBarang_hargaBeli;
                    $sisaStok = $model->msBarang->MsBarang_stok;
                    $barang->MsBarang_stok = $sisaStok - $qtyAwal + $model->TrDetail_qty;
                }

                // Manipulasi Diskon
                if ($model->TrDetail_diskon)
                {
                    $diskon = $model->TrDetail_diskon / 100;
                    $model->TrDetail_jumlahHarga = $harga - $diskon * $harga;
                    $model->TrDetail_jumlahHarga = $model->TrDetail_jumlahHarga * $model->TrDetail_qty;
                }
                else {
                    $model->TrDetail_jumlahHarga = $model->TrDetail_qty * $harga;
                }

                // Mengatur Hutang / Piutang
                $customer = MsCustomer::getCustomer($model->trHeader->MsCustomer_id);
                if ($model->trHeader->TrHeader_tipe === 'Penjualan')
                {
                    if (!$model->trHeader->TrHeader_paymentStatus)
                    {
                        $customer->MsCustomer_hutang = $customer->MsCustomer_hutang + $model->TrDetail_jumlahHarga;
                    }
                } 
                else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
                {
                    if (!$model->trHeader->TrHeader_paymentStatus)
                    {
                        $customer->MsCustomer_piutang = $customer->MsCustomer_piutang + $model->TrDetail_jumlahHarga;
                    }
                }

                if ($model->save() && $barang->save() && $customer->save())
                {
                    return $this->redirect(['view', 'TrHeader_id' => $model->TrHeader_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('_detail-update', [
            'model' => $model,
            'listBarang' => $listBarang,
        ]);
    }

    /**
     * Deletes an existing TrDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrDetail_id Tr Detail ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetailDelete($TrDetail_id)
    {
        $model = $this->findDetail($TrDetail_id);
        $idHeader = $model->TrHeader_id;
        $barang = MsBarang::getBarang($model->MsBarang_id);
        if ($model->trHeader->TrHeader_tipe === 'Penjualan')
        {
            $barang->MsBarang_stok = $model->msBarang->MsBarang_stok + $model->TrDetail_qty;
            if ($barang->save() && $model->delete()){
                return $this->redirect(['view', 'TrHeader_id' => $idHeader]);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menghapus data!');
                return $this->redirect(['view', 'TrHeader_id' => $idHeader]);
            }
        }
        else if ($model->trHeader->TrHeader_tipe === 'Pembelian')
        {
            $barang->MsBarang_stok = $model->msBarang->MsBarang_stok - $model->TrDetail_qty;
            if ($barang->save() && $model->delete()){
                return $this->redirect(['view', 'TrHeader_id' => $idHeader]);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menghapus data!');
                return $this->redirect(['view', 'TrHeader_id' => $idHeader]);
            }
        };
    }

    protected function findDetail($TrDetail_id)
    {
        if (($model = TrDetail::findOne(['TrDetail_id' => $TrDetail_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Melakukan pelunasan tagihan penjualan/pembelian
     * @param int $TrHeader_id Tr Header ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPelunasan($TrHeader_id)
    {
        $model =  $this->findModel($TrHeader_id);
        $customerDetail = MsCustomer::findOne(['MsCustomer_id' => $model->MsCustomer_id]);
        $totalHarga = 0;
        switch ($model->TrHeader_tipe) {
            case 'Penjualan':
                $model->TrHeader_paymentStatus = 1;
                foreach ($model->trDetails as $detail)
                {
                    $totalHarga += $detail->TrDetail_jumlahHarga;
                }
                $customerDetail->MsCustomer_hutang = $customerDetail->MsCustomer_hutang - $totalHarga;
                break;
            case 'Pembelian':
                $model->TrHeader_paymentStatus = 1;
                foreach ($model->trDetails as $detail)
                {
                    $totalHarga += $detail->TrDetail_jumlahHarga;
                }
                $customerDetail->MsCustomer_piutang = $customerDetail->MsCustomer_piutang - $totalHarga;
                break;
        }
        // echo '<pre>'; print_r($customerDetail); die();
        if ($model->save() && $customerDetail->save()) {
            return $this->redirect(['view', 'TrHeader_id' => $model->TrHeader_id]);
        } else {
            Yii::$app->session->setFlash('error', 'Gagal mengupdate data!');
            return $this->redirect(['view', 'TrHeader_id' => $model->TrHeader_id]);
        }
    }
}
