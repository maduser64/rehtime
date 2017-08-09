<?php

namespace app\controllers;

use Yii;
use app\models\Leavetype;
use app\models\LeavetypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeavetypeController implements the CRUD actions for Leavetype model.
 */
class LeavetypeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Leavetype models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeavetypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leavetype model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Leavetype();

        if ($model->load(Yii::$app->request->post())){

            if($model->save()) {

            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'เรียบร้อย! บันทึกข้อมูลเรียบร้อย...',
                'options'=>['class'=>'alert-success']
                ]);

                return $this->redirect(['create']);
            } 

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Leavetype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){

            if($model->save()) {

            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'เรียบร้อย! แก้ไขข้อมูลเรียบร้อย...',
                'options'=>['class'=>'alert-success']
                ]);

                return $this->redirect(['update','id'=> $id]);
            } 

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    
    }

    /**
     * Deletes an existing Leavetype model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Leavetype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leavetype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leavetype::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
