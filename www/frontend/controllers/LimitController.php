<?php

namespace frontend\controllers;

use app\models\Expenses;
use app\models\Incomes;
use Yii;
use app\models\Limit;
use app\models\LimitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTime;
use DateTimeZone;

/**
 * LimitController implements the CRUD actions for Limit model.
 */
class LimitController extends Controller
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
     * Lists all Books models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LimitSearch();
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
        $model = new Limit();
        $existingLimit = Limit::find()->where(['create_by' => Yii::$app->user->identity->id])->one();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $income = Incomes::find()->where(["create_by"=>(String)Yii::$app->user->identity->id])->all();
                $totalIncome = 0;
                foreach ($income as $i) {
                    $totalIncome += (int)$i->amount;
                }

                $expense = Expenses::find()->where(["create_by"=>(String)Yii::$app->user->identity->id])->all();
                $totalExpense = 0;
                foreach ($expense as $e) {
                    $totalExpense += (int)$e->amount;
                }

                $balance = $totalIncome - $totalExpense;

                if ($existingLimit === null) {
                    if (empty($model->create_date)) {
                        $timezone = new DateTimeZone('Asia/Bangkok');
                        $currentDateTime = new DateTime('now', $timezone);
                        $formatter = Yii::$app->formatter;
                        $formatter->locale = 'th-TH';
                        $model->create_date = $formatter->asDate($currentDateTime, 'yyyy-MM-dd');
                    }
                    if ((int)$model->amount > (int)$balance) {
                        $model->addError('amount', '*Please enter an amount less than your balance');
                    }
                    else if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Limit Added');
                        return $this->redirect(['site/overview']);
                    }
                } else {
                    Yii::$app->session->setFlash('info', 'Limit has already been added.');
                    return $this->redirect(['site/overview']);
                }
                return $this->redirect(['site/overview']);
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            
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
        Yii::$app->session->setFlash('danger', 'Limit Deleted');
        return $this->redirect(['index']);
    }

     /**
     * Finds the Types model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $_id ID
     * @return Limit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($_id)
    {
        if (($model = Limit::findOne(['_id' => $_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
