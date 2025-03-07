<?php

namespace frontend\controllers;

use app\models\MsCustomer;
use app\models\MsCustomerSearch;
use app\models\TrDetailSearch;
use app\models\TrHeader;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerController implements the CRUD actions for MsCustomer model.
 */
class CustomerController extends Controller
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
     * Lists all MsCustomer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MsCustomerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsCustomer model.
     * @param int $MsCustomer_id Ms Customer ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($MsCustomer_id)
    {
        $transactionSearchModel = new trdetailsearch();
        $transactionSearchModel->MsCustomer_id = $MsCustomer_id;
        $transactionDataProvider = $transactionSearchModel->search($this->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($MsCustomer_id),
            'transactionSearchModel' => $transactionSearchModel,
            'transactionDataProvider' => $transactionDataProvider,
        ]);
    }

    /**
     * Creates a new MsCustomer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($isAddTransaction = null,  $TrHeader_tipe = null)
    {
        $model = new MsCustomer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($isAddTransaction) {
                    return $this->redirect(['transaction-header/create-multiple-detail', 'MsCustomer_id' => $model->MsCustomer_id, 'TrHeader_tipe' => $TrHeader_tipe]);
                }
                return $this->redirect(['view', 'MsCustomer_id' => $model->MsCustomer_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MsCustomer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $MsCustomer_id Ms Customer ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($MsCustomer_id)
    {
        $model = $this->findModel($MsCustomer_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'MsCustomer_id' => $model->MsCustomer_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MsCustomer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $MsCustomer_id Ms Customer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($MsCustomer_id)
    {
        $this->findModel($MsCustomer_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing MsCustomer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $MsCustomer_id Ms Customer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionNewTransaction($MsCustomer_id)
    {
        return $this->redirect(['transaction-header/create', 'MsCustomer_id' => $MsCustomer_id]);
    }

    /**
     * Finds the MsCustomer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $MsCustomer_id Ms Customer ID
     * @return MsCustomer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($MsCustomer_id)
    {
        if (($model = MsCustomer::findOne(['MsCustomer_id' => $MsCustomer_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
