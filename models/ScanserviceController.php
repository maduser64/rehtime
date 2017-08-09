<?php

namespace app\controllers;

use Yii;
use app\models\Scanservice;
use app\models\ScanserviceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScanserviceController implements the CRUD actions for Scanservice model.
 */
class ScanserviceController extends Controller
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
     * Lists all Scanservice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScanserviceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Scanservice model.
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
     * Creates a new Scanservice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scanservice();

        if ($model->load(Yii::$app->request->post())){

            if (isset($_POST["depart_id"])) {
                $depart =  $_POST["depart_id"];
                $user = $model->user_id;


                foreach ($depart as $x) {
                    $depart = $x;

                    $sql = "INSERT INTO scan_service (service_id, user_id, depart_id)
                             VALUES (NULL, '$user', '$depart')";

                    Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน


                           
                }
            }
             Yii::$app->getSession()->setFlash('alert',[
                        'body'=>'เรียบร้อย! บันทึกข้อมูลเรียบร้อย...',
                        'options'=>['class'=>'alert-success']
            ]);

            return $this->redirect(['create']); 

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Scanservice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        if (isset($_POST["user_id"])) {
            $user_id =  $_POST["user_id"];

            $sql = "DELETE FROM scan_service
                    WHERE user_id = '$user_id' ";

            Yii::$app->db->createCommand($sql)->execute();


            if (isset($_POST["depart_id"])) {
                $depart =  $_POST["depart_id"];
                $user = $_POST["user_id"];


                foreach ($depart as $x) {
                    $depart = $x;

                    $sql = "INSERT INTO scan_service (service_id, user_id, depart_id)
                             VALUES (NULL, '$user', '$depart')";

                    Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน


                           
                }
            }
             Yii::$app->getSession()->setFlash('alert',[
                        'body'=>'เรียบร้อย! ปรับปรุงข้อมูลเรียบร้อย...',
                        'options'=>['class'=>'alert-success']
            ]);

            return $this->render('update', [
                'id' => $id,
             ]);

        }else{
            return $this->render('update', [
                'id' => $id,
             ]);
        }
    }

    /**
     * Deletes an existing Scanservice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $sql = "DELETE FROM scan_service
                    WHERE user_id = '$id' ";

        Yii::$app->db->createCommand($sql)->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Scanservice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Scanservice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Scanservice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
