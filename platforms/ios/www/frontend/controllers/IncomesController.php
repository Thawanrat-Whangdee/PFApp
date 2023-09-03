<?php

namespace frontend\controllers;

use Yii;
use app\models\Incomes;
use app\models\IncomesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTime;
use DateTimeZone;

/**
 * IncomesController implements the CRUD actions for Incomes model.
 */
class IncomesController extends Controller
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
     * Lists all Categories models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IncomesSearch();
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
        $model = new Incomes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($this->validateAndSaveIncome($model)) {
                    return $this->redirect(['site/overview']);
                }
            }  
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    private function validateAndSaveIncome($model) {
        if (empty($model->income_type)) {
            $model->addError('income_type', '*Income type cannot be blank.');
        }
        
        if (empty($model->amount)) {
            $model->addError('amount', '*Amount cannot be blank.');
        } elseif (!is_numeric($model->amount)) {
            $model->addError('amount', '*Please enter decimal or numbers.');
        }
    
        if ($model->hasErrors()) {
            return false;
        }
    
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Income Added');
            return true;
        }
    
        return false;
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            
            if(empty($model->update_date)){
                $model->update_date = time();
                $model->update_date = Yii::$app->formatter->asDate($model->update_date, 'yyyy-MM-dd');
            }
            if ($model->save()) {
                return $this->redirect(['view', '_id' => (string) $model->_id]);
            }
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
        Yii::$app->session->setFlash('danger', 'Income Deleted');
        return $this->redirect(['index']);
    }

     /**
     * Finds the Types model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $_id ID
     * @return Incomes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($_id)
    {
        if (($model = Incomes::findOne(['_id' => $_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
