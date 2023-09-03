<?php

namespace frontend\controllers;

use app\models\Pocket;
use app\models\PocketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use DateTime;
use DateTimeZone;

/**
 * PocketController implements the CRUD actions for Pocket model.
 */
class PocketController extends Controller
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
     * Lists all Pocket models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PocketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pocket model.
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
     * Creates a new Pocket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pocket();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if(empty($model->create_date)) {
                    $timezone = new DateTimeZone('Asia/Bangkok');
                    $currentDateTime = new DateTime('now', $timezone);
                    $model->create_date = $currentDateTime->format('Y-m-d');
                }
                if(empty($model->ratio)){
                    $model->ratio = 0;
                }
                $existingType = Pocket::find()
                    ->where(['pocket_name' => $model->pocket_name])
                    ->andWhere(["user_id" => (string) Yii::$app->user->identity->id])
                    ->exists();
                if ($existingType) {
                    $model->addError('pocket_name', '*This pocket name has already been taken.');
                } else if (empty($model->pocket_name)) {
                    $model->addError('pocket_name', '*Type name cannot be blank.');
                } else if (!ctype_alpha($model->pocket_name)) {
                    $model->addError('pocket_name', '*Please enter text.');
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Pocket Added');
                        return $this->redirect(['site/pocketlist']);
                    }
                }
                
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pocket model.
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
     * Deletes an existing Pocket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $_id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($_id)
    {
        $this->findModel($_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pocket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $_id ID
     * @return Pocket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($_id)
    {
        if (($model = Pocket::findOne(['_id' => $_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
