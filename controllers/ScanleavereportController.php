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


        if($model->load(Yii::$app->request->post())){

            //จัดแบบเกียนๆ เลยกู 5555 ห้ามลอกเลียนแบบนะเด็ก
            $sql = "SELECT
                leavetype_id,date,date_end,userid
            FROM
                scan_leave_report
            WHERE leave_id = '$id'; "; 
                //=====================SQL==========================================

            $rw = Yii::$app->db->createCommand($sql)->queryAll();

            foreach ($rw as $r) {
               $leavetype_id = $r['leavetype_id'];
               $date = $r['date'];
               $date_end = $r['date_end'];
               $userid = $r['userid'];
            }

            /////////////////////////////////////////////////

            $sql = "DELETE FROM scan_leave
                    WHERE userid = '$userid'
            AND DATE_FORMAT(date,'%Y-%m-%d') BETWEEN '$date' AND '$date_end';";

            Yii::$app->db->createCommand($sql)->execute();


            $model->leavetype_id = $leavetype_id;
            if(isset($model->leave_ass)){
               $model->leave_ass = $model->leave_ass; 
               }else{
                    $model->leave_ass = "";
               }



            if($model->save()) {



            $strStartDate = $model->date;
            $strEndDate = $model->date_end;

            $date_strat = $model->date;
            $date_end = $model->date_end;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intPublicHoliday = 0;
            $Descripiton = 0;
            $count_leave = 0;


            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;
            $strStartDate = date("Y-m-d", strtotime("-1 day", strtotime($strStartDate)));
            $strEndDate = date("Y-m-d", strtotime("-1 day", strtotime($strEndDate)));




            //---------------------------------------------------------------------------------------
            $leave_save = Yii::$app->session["fname"] ."  ".Yii::$app->session["lname"];
            
            //$model->depart = Yii::$app->session["defaultdepid"];
            $depart = Yii::$app->session["defaultdepid"];
            $leave_ass =  $model->leave_ass;
            $leavetype_id = $model->leavetype_id;
            $leave_cause = $model->leave_cause;
            $leave_ass = $model->leave_ass;
            $userid1 =  $userid;
           

            $i = 0;
            while (strtotime($strStartDate) <= strtotime($strEndDate)){
                $i++;

                $DayOfWeek = date("w", strtotime($strStartDate));

                if($DayOfWeek == 0 or $DayOfWeek == 6)  // 0 = Sunday, 6 = Saturday;
                {
                    $intHoliday++;

                    $day = $strStartDate;

                }else{
                    $intWorkDay++;
                    $day = $strStartDate;
                }

                echo "<br>";
                $strStartDate = date("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));

                  

                    $sql = "INSERT INTO scan_leave (leave_id, userid, depart, leavetype_id, date,date_end,leave_save , commend,commend1,leave_ass,leave_cause)
                             VALUES (NULL, '$userid1', '$depart', '$leavetype_id', '$strStartDate','$date_end',
                             '$leave_save','$model->commend','$model->commend1','$leave_ass','$leave_cause')";

                    Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน

                    //---------------------------------------------------------------------------------------

                }

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
     * Updates an existing Scanleavereport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateadmin($id)
    {
        $model = $this->findModel($id);


        if($model->load(Yii::$app->request->post())){

             //จัดแบบเกียนๆ เลยกู 5555 ห้ามลอกเลียนแบบนะเด็ก
                $sql = "SELECT
                    leavetype_id,date,date_end,userid
                FROM
                    scan_leave_report
                WHERE leave_id = '$id'; "; 
                    //=====================SQL==========================================

                $rw = Yii::$app->db->createCommand($sql)->queryAll();

                foreach ($rw as $r) {
                   $leavetype_id = $r['leavetype_id'];
                   $date = $r['date'];
                   $date_end = $r['date_end'];
                   $userid = $r['userid'];
                }

                /////////////////////////////////////////////////

                $sql = "DELETE FROM scan_leave
                        WHERE userid = '$userid'
                AND DATE_FORMAT(date,'%Y-%m-%d') BETWEEN '$date' AND '$date_end';";

                Yii::$app->db->createCommand($sql)->execute();


            $model->leavetype_id = $leavetype_id;
            if(isset($model->leave_ass)){
               $model->leave_ass = $model->leave_ass; 
               }else{
                    $model->leave_ass = "";
               }



            if($model->save()) {



            $strStartDate = $model->date;
            $strEndDate = $model->date_end;

            $date_strat = $model->date;
            $date_end = $model->date_end;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intPublicHoliday = 0;
            $Descripiton = 0;
            $count_leave = 0;


            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;
            $strStartDate = date("Y-m-d", strtotime("-1 day", strtotime($strStartDate)));
            $strEndDate = date("Y-m-d", strtotime("-1 day", strtotime($strEndDate)));




            //---------------------------------------------------------------------------------------
            $leave_save = Yii::$app->session["fname"] ."  ".Yii::$app->session["lname"];
            
            //$model->depart = Yii::$app->session["defaultdepid"];
            $depart = $model->depart;
            $leave_ass =  $model->leave_ass;
            $leavetype_id = $model->leavetype_id;
            $leave_cause = $model->leave_cause;
            $leave_ass = $model->leave_ass;
            $userid1 =  $userid;
           

            $i = 0;
            while (strtotime($strStartDate) <= strtotime($strEndDate)){
                $i++;

                $DayOfWeek = date("w", strtotime($strStartDate));

                if($DayOfWeek == 0 or $DayOfWeek == 6)  // 0 = Sunday, 6 = Saturday;
                {
                    $intHoliday++;

                    $day = $strStartDate;

                }else{
                    $intWorkDay++;
                    $day = $strStartDate;
                }

                echo "<br>";
                $strStartDate = date("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));

                  

                    $sql = "INSERT INTO scan_leave (leave_id, userid, depart, leavetype_id, date,date_end,leave_save , commend,commend1,leave_ass,leave_cause)
                             VALUES (NULL, '$userid1', '$depart', '$leavetype_id', '$strStartDate','$date_end',
                             '$leave_save','$model->commend','$model->commend1','$leave_ass','$leave_cause')";

                    Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน

                    //---------------------------------------------------------------------------------------

                }

                Yii::$app->getSession()->setFlash('alert',[
                        'body'=>'เรียบร้อย! แก้ไขข้อมูลเรียบร้อย...',
                        'options'=>['class'=>'alert-success']
                ]);

                return $this->redirect(['updateadmin', 'id' => $model->leave_id]);
            }
        } else {
            return $this->render('updateadmin', [
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
