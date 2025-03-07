<?php

namespace frontend\controllers;

use app\models\TrDetail;
use app\models\TrDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransactionDetailController implements the CRUD actions for TrDetail model.
 */
class TransactionDetailController extends Controller
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
     * Lists all TrDetail models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TrDetailSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrDetail model.
     * @param int $TrDetail_id Tr Detail ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TrDetail_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($TrDetail_id),
        ]);
    }

    /**
     * Creates a new TrDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TrDetail();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'TrDetail_id' => $model->TrDetail_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TrDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TrDetail_id Tr Detail ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TrDetail_id)
    {
        $model = $this->findModel($TrDetail_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TrDetail_id' => $model->TrDetail_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TrDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TrDetail_id Tr Detail ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TrDetail_id)
    {
        $this->findModel($TrDetail_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $TrDetail_id Tr Detail ID
     * @return TrDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TrDetail_id)
    {
        if (($model = TrDetail::findOne(['TrDetail_id' => $TrDetail_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
