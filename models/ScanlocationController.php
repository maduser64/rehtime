<?php

namespace app\controllers;

use Yii;
use app\models\Scanlocation;
use app\models\ScanlocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScanlocationController implements the CRUD actions for Scanlocation model.
 */
class ScanlocationController extends Controller
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
     * Lists all Scanlocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScanlocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Scanlocation model.
     * @param integer $scan_id
     * @param string $scan_ip
     * @return mixed
     */
    public function actionView($scan_id, $scan_ip)
    {
        return $this->render('view', [
            'model' => $this->findModel($scan_id, $scan_ip),
        ]);
    }

    /**
     * Creates a new Scanlocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scanlocation();

        if ($model->load(Yii::$app->request->post())){

            $model->lest_update = date('Y-m-d H:i:s');
            
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
     * Updates an existing Scanlocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $scan_id
     * @param string $scan_ip
     * @return mixed
     */
    public function actionUpdate($scan_id, $scan_ip)
    {
        $model = $this->findModel($scan_id, $scan_ip);

        if ($model->load(Yii::$app->request->post())){

            //$model->last_update = date('Y-m-d H:i:s');

            if($model->save()) {

            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'เรียบร้อย! แก้ไขข้อมูลเรียบร้อย...',
                'options'=>['class'=>'alert-success']
                ]);

                return $this->redirect(['update','scan_id' => $model->scan_id, 'scan_ip' => $model->scan_ip]);
            } 

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Scanlocation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $scan_id
     * @param string $scan_ip
     * @return mixed
     */
    public function actionDelete($scan_id, $scan_ip)
    {
        $this->findModel($scan_id, $scan_ip)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Scanlocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $scan_id
     * @param string $scan_ip
     * @return Scanlocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($scan_id, $scan_ip)
    {
        if (($model = Scanlocation::findOne(['scan_id' => $scan_id, 'scan_ip' => $scan_ip])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
