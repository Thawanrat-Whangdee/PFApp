<?php

namespace frontend\controllers;

use Yii;
use app\models\Savings;
use app\models\SavingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SavingsController implements the CRUD actions for Savings model.
 */
class SavingsController extends Controller
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
     * Lists all Savings models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SavingsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Displays a single Books model.
     * @param int $_id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($_id),
        ]);
    }

     /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Savings();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (empty($model->amount)) {
                    $model->addError('amount', '*Amount cannot be blank.');
                } elseif (!is_numeric($model->amount)) {
                    $model->addError('amount', '*Please enter decimal or numbers.');
                }
                if (empty($model->start_date)) {
                    $model->addError('start_date', '*Start date cannot be blank.');
                }
                if (empty($model->end_date)) {
                    $model->addError('end_date', '*End date cannot be blank.');
                }
                if (!empty($model->start_date) && !empty($model->end_date)) {
                    $startMonth = date('m', strtotime($model->start_date));
                    $endMonth = date('m', strtotime($model->end_date));
                    $startYear = date('y', strtotime($model->start_date));
                    $endYear = date('y', strtotime($model->end_date));
        
                    if (($startMonth === $endMonth) && ($startYear === $endYear)) {
                        $model->addError('end_date', 'Please enter a duration greater than one month.');
                    }
                }
                if (!$model->hasErrors() && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Saving Added');
                    return $this->redirect(['site/overview']);
                }
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

     /**
     * Updates an existing Types model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $_id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($_id)
    {
        $model = $this->findModel($_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', '_id' => (string) $model->_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

     /**
     * Deletes an existing Types model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $_id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($_id)
    {
        $this->findModel($_id)->delete();
        Yii::$app->session->setFlash('danger', 'Saving Deleted');
        return $this->redirect(['index']);
    }

     /**
     * Finds the Types model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $_id ID
     * @return Savings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($_id)
    {
        if (($model = Savings::findOne(['_id' => $_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
