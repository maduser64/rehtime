<?php

namespace app\controllers;

use Yii;
use app\models\Scanleavereport;
use app\models\ScanleavereportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScanleavereportController implements the CRUD actions for Scanleavereport model.
 */
class ScanleavereportController extends Controller
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
     * Lists all Scanleavereport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScanleavereportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Scanlocation models.
     * @return mixed
     */
    public function actionIndexadmin()
    {
        $searchModel = new ScanleavereportSearch();
        $dataProvider = $searchModel->searchadmin(Yii::$app->request->queryParams);

        return $this->render('indexadmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Scanleavereport model.
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
     * Creates a new Scanleavereport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scanleavereport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->leave_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Scanleavereport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        //จัดแบบเกียนๆ เลยกู 5555 ห้ามลอกเลียนแบบนะเด็ก
        $sql = "SELECT
            leavetype_id
        FROM
            scan_leave_report
        WHERE leave_id = '$id'; "; 
            //=====================SQL==========================================

        $rw = Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rw as $r) {
           $leavetype_id = $r['leavetype_id'];
        }

        /////////////////////////////////////////////////




        if ($model->load(Yii::$app->request->post())){

            $model->leavetype_id = $leavetype_id;
            if(isset($_POST["leave_ass"])){
               $model->leave_ass = $_POST["leave_ass"]; 
           }else{
                $model->leave_ass = "";
           }
            
            

            if($model->save()) {
                Yii::$app->getSession()->setFlash('alert',[
                        'body'=>'เรียบร้อย! แก้ไขข้อมูลเรียบร้อย...',
                        'options'=>['class'=>'alert-success']
                ]);

                return $this->redirect(['update', 'id' => $model->leave_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Scanleavereport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $sql = "SELECT * 
                FROM scan_leave_report
                WHERE leave_id = '$id'; "; 
        //=====================SQL==========================================

        $rw1 = Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rw1 as $r) {
            $userid = $r['userid'];
            $date = $r['date'];
            $date_end = $r['date_end'];
        }


        $sql = "DELETE FROM scan_leave
                WHERE userid = '$userid'
        AND DATE_FORMAT(date,'%Y-%m-%d') BETWEEN '$date' AND '$date_end';";

        Yii::$app->db->createCommand($sql)->execute();


        $this->findModel($id)->delete();


        //ScanleavereportSearch%5Buserid%5D=1735&ScanleavereportSearch%5Bdepart%5D=
        //indexadmin?ScanleavereportSearch%5Buserid%5D=1735&ScanleavereportSearch%5Bdepart%5D=
        //return $this->redirect('indexadmin',['userid' => $userid]);
        return $this->redirect(['indexadmin?ScanleavereportSearch%5Buserid%5D='.$userid.'&ScanleavereportSearch%5Bdepart%5D=']);
    }

    /**
     * Finds the Scanleavereport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Scanleavereport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Scanleavereport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
