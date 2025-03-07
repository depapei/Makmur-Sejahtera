<?php

namespace frontend\controllers;

use app\models\MsBarang;
use app\models\MsBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BarangController implements the CRUD actions for MsBarang model.
 */
class BarangController extends Controller
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
     * Lists all MsBarang models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MsBarangSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsBarang model.
     * @param int $MsBarang_id Ms Barang ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($MsBarang_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($MsBarang_id),
        ]);
    }

    /**
     * Creates a new MsBarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MsBarang();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'MsBarang_id' => $model->MsBarang_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MsBarang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $MsBarang_id Ms Barang ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($MsBarang_id)
    {
        $model = $this->findModel($MsBarang_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'MsBarang_id' => $model->MsBarang_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MsBarang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $MsBarang_id Ms Barang ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($MsBarang_id)
    {
        $this->findModel($MsBarang_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MsBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $MsBarang_id Ms Barang ID
     * @return MsBarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($MsBarang_id)
    {
        if (($model = MsBarang::findOne(['MsBarang_id' => $MsBarang_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
