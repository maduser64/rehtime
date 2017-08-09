<?php

namespace app\controllers;

use Yii;
use app\models\Userinfo;
use app\models\UserinfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserinfoController implements the CRUD actions for Userinfo model.
 */
class UserinfoController extends Controller
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
     * Lists all Userinfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserinfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Userinfo models.
     * @return mixed
     */
    public function actionIndexdepart($id)
    {
        $searchModel = new UserinfoSearch();
        $dataProvider = $searchModel->searchdepart($id);

        return $this->render('indexdepart', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Userinfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Userinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Userinfo();

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
     * Updates an existing Userinfo model.
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
     * Updates an existing Userinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateuser1($id)
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
            return $this->render('_updateuser', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Lists all Userinfo models.
     * @return mixed
     */
    public function actionUpdateuser()
    {
        $scandepart_id = Yii::$app->session["defaultdepid"];

        $searchModel = new UserinfoSearch();
        $dataProvider = $searchModel->searchupdate($scandepart_id);

        return $this->render('updateuser', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Userinfo model.
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
     * Finds the Userinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Userinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
