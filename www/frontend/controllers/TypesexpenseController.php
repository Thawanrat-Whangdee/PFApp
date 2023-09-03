<?php

namespace frontend\controllers;

use app\models\Typesexpense;
use app\models\TypesexpenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * TypesexpenseController implements the CRUD actions for Typesexpense model.
 */
class TypesexpenseController extends Controller
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
     * Lists all Typesexpense models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TypesexpenseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Typesexpense model.
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
     * Creates a new Typesexpense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Typesexpense();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $existingType = Typesexpense::find()->where(['type_name' => $model->type_name])->exists();
                if ($existingType) {
                    $model->addError('type_name', 'This expense type name has already been taken.');
                } else if (empty($model->type_name)) {
                    $model->addError('type_name', 'Type name cannot be blank.');
                } else if (!ctype_alpha($model->type_name)) {
                    $model->addError('type_name', 'Please enter text.');
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Expense Type Added');
                        return $this->redirect(['index']);
                    }
                }
                
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Typesexpense model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $_id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($_id)
    {
        $model = $this->findModel($_id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $existingType = Typesexpense::find()->where(['type_name' => $model->type_name])->exists();
                if ($existingType) {
                    $model->addError('type_name', 'This expense type name has already been taken.');
                } else if (empty($model->type_name)) {
                    $model->addError('type_name', 'Type name cannot be blank.');
                } else if (!ctype_alpha($model->type_name)) {
                    $model->addError('type_name', 'Please enter text.');
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Expense Type Added');
                        return $this->redirect(['index']);
                    }
                }
                
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Typesexpense model.
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
     * Finds the Typesexpense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $_id ID
     * @return Typesexpense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($_id)
    {
        if (($model = Typesexpense::findOne(['_id' => $_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
