<?php

namespace app\controllers;

use Yii;
use app\models\Leave;
use app\models\LeaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeaveController implements the CRUD actions for Leave model.
 */
class LeaveController extends Controller
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
     * Lists all Leave models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeaveSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Leave models.
     * @return mixed
     */
    public function actionIndexdepart()
    {
        $searchModel = new LeaveSearch();

        $dataProvider = $searchModel->searchdepart(Yii::$app->request->queryParams);
        

        return $this->render('indexdepart', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Leave models.
     * @return mixed
     */
    public function actionIndexdepartdate($date)
    {
        $searchModel = new LeaveSearch();

        $dataProvider = $searchModel->searchdepartdate($date);
        

        return $this->render('indexdepartdate', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leave model.
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
     * Displays a single Leave model.
     * @param integer $id
     * @return mixed
     */
    public function actionPrint($id)
    {
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

        if($leavetype_id == 3){
            $pdf = 'report'; //file name
        }elseif($leavetype_id == 2){
            $pdf = 'reportall';

        }elseif($leavetype_id == 4){
            $pdf = 'reportall';

        }elseif($leavetype_id == 5){
            $pdf = 'reportall';

        }


        

        return $this->renderPartial($pdf, [
            'id' => $id
            ]);
    }

     /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new Leave();

        if ($model->load(Yii::$app->request->post())){

            $strStartDate = $model->date;
            $strEndDate = $model->status;
            $date_strat = $model->date;
            $date_end = $model->status;


            $intWorkDay = 0;
            $intHoliday = 0;
            $intPublicHoliday = 0;
            $Descripiton = 0;
            $count_leave = 0;

            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;
            $strStartDate = date("Y-m-d", strtotime("-1 day", strtotime($strStartDate)));
            $strEndDate = date("Y-m-d", strtotime("-1 day", strtotime($strEndDate)));


            //---------------------------------------------------------------------------------------
            $model->leave_save = Yii::$app->session["fname"] ."  ".Yii::$app->session["lname"];
            //$model->depart = Yii::$app->session["defaultdepid"];
            $leave_ass =  $_POST["leave_ass"];
           

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


                    if (isset($model->userid)) {
                        $userid =  $model->userid;

                        $leavetype_id = $model->leavetype_id;

                         //ลากิจ
                        if($leavetype_id == '2'){
                            $leave_ass =  $_POST["leave_ass"];
                            $leave_position = $_POST["leave_position2"];
                            $leave_beloag = $_POST["leave_beloag2"];
                            $leave_cotton = "";
                            $leave_address = $_POST["leave_address2"];
                            $leave_cause = $_POST["leave_cause2"];
                        }
                        //ลาป่วย
                        else if($leavetype_id == '4'){
                            $leave_ass =  $_POST["leave_ass1"];
                            $leave_position = $_POST["leave_position4"];
                            $leave_beloag = $_POST["leave_beloag4"];
                            $leave_cause = $_POST["leave_cause4"];
                            $leave_cotton = "";
                            $leave_address = $_POST["leave_address4"];
                        }
                        //ลาคลอดบุตร
                        elseif($leavetype_id == '5'){
                            $leave_ass =  $_POST["leave_ass2"];
                            $leave_position = $_POST["leave_position5"];
                            $leave_beloag = $_POST["leave_beloag5"];
                            $leave_cotton = $_POST["leave_cotton5"];
                            $leave_address = $_POST["leave_address5"];
                            $leave_cause = $_POST["leave_cause5"];

                        }elseif($leavetype_id == '3'){
                            $leave_ass =  $_POST["leave_ass3"];
                            $leave_position = $_POST["leave_position3"];
                            $leave_beloag = $_POST["leave_beloag3"];
                            $leave_cotton = $_POST["leave_cotton3"];
                            $leave_address = $_POST["leave_address3"];
                            $leave_cause = "";
                        }else{
                            $leave_position = "";
                            $leave_beloag = "";
                            $leave_cotton = "";
                            $leave_address = "";
                            $leave_cause = "";
                            $leave_ass = "";

                        }

                        foreach ($userid as $x) {
                            $userid = $x;

                            $sql = "INSERT INTO scan_leave (leave_id, userid, depart, leavetype_id, date,date_end,leave_save , commend,commend1, leave_beloag, leave_cotton, leave_address,leave_ass,leave_position,leave_cause)
                                     VALUES (NULL, '$userid', '$model->depart', '$model->leavetype_id', '$strStartDate','$date_end', '$model->leave_save','$model->commend','$model->commend1'
                                     ,'$leave_beloag','$leave_cotton','$leave_address','$leave_ass','$leave_position','$leave_cause')";

                            Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน


                           
                        }

                    }
                    //---------------------------------------------------------------------------------------

            }

            //บรรทึกเพื่อสงออกรายงาน
             //---------------------------------------------------------------------------------------
                    $model->leave_save = Yii::$app->session["fname"] ."  ".Yii::$app->session["lname"];
                    
                    //$model->depart = Yii::$app->session["defaultdepid"];

                   

                    if (isset($model->userid)) {
                        $userid =  $model->userid;
                       

                        foreach ($userid as $x) {
                            $userid = $x;

                            $sql = "INSERT INTO scan_leave_report (leave_id, userid, depart, leavetype_id, date,date_end,leave_save , commend,commend1, leave_beloag, leave_cotton, leave_address,leave_ass,leave_position,leave_cause)
                                     VALUES (NULL, '$userid', '$model->depart', '$model->leavetype_id', '$date_strat','$date_end', '$model->leave_save','$model->commend','$model->commend1'
                                     ,'$leave_beloag','$leave_cotton','$leave_address','$leave_ass','$leave_position','$leave_cause')";

                            Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน

                        }

                        //$model->userid = $userid;

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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedepart(){
        $model = new Leave();

        if ($model->load(Yii::$app->request->post())){

            $strStartDate = $model->date;
            $strEndDate = $model->status;
            $date_strat = $model->date;
            $date_end = $model->status;


            $intWorkDay = 0;
            $intHoliday = 0;
            $intPublicHoliday = 0;
            $Descripiton = 0;
            $count_leave = 0;

            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;
            $strStartDate = date("Y-m-d", strtotime("-1 day", strtotime($strStartDate)));
            $strEndDate = date("Y-m-d", strtotime("-1 day", strtotime($strEndDate)));


            //---------------------------------------------------------------------------------------
            $model->leave_save = Yii::$app->session["fname"] ."  ".Yii::$app->session["lname"];
            $model->depart = Yii::$app->session["defaultdepid"];
            $leave_ass =  $_POST["leave_ass"];
           

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


                    if (isset($model->userid)) {
                        $userid =  $model->userid;

                        $leavetype_id = $model->leavetype_id;

                         //ลากิจ
                        if($leavetype_id == '2'){
                            $leave_ass =  $_POST["leave_ass"];
                            $leave_position = $_POST["leave_position2"];
                            $leave_beloag = $_POST["leave_beloag2"];
                            $leave_cotton = "";
                            $leave_address = $_POST["leave_address2"];
                            $leave_cause = $_POST["leave_cause2"];
                        }
                        //ลาป่วย
                        else if($leavetype_id == '4'){
                            $leave_ass =  $_POST["leave_ass1"];
                            $leave_position = $_POST["leave_position4"];
                            $leave_beloag = $_POST["leave_beloag4"];
                            $leave_cause = $_POST["leave_cause4"];
                            $leave_cotton = "";
                            $leave_address = $_POST["leave_address4"];
                        }
                        //ลาคลอดบุตร
                        elseif($leavetype_id == '5'){
                            $leave_ass =  $_POST["leave_ass2"];
                            $leave_position = $_POST["leave_position5"];
                            $leave_beloag = $_POST["leave_beloag5"];
                            $leave_cotton = $_POST["leave_cotton5"];
                            $leave_address = $_POST["leave_address5"];
                            $leave_cause = $_POST["leave_cause5"];

                        }elseif($leavetype_id == '3'){
                            $leave_ass =  $_POST["leave_ass3"];
                            $leave_position = $_POST["leave_position3"];
                            $leave_beloag = $_POST["leave_beloag3"];
                            $leave_cotton = $_POST["leave_cotton3"];
                            $leave_address = $_POST["leave_address3"];
                            $leave_cause = "";
                        }else{
                            $leave_position = "";
                            $leave_beloag = "";
                            $leave_cotton = "";
                            $leave_address = "";
                            $leave_cause = "";
                            $leave_ass = "";

                        }

                        foreach ($userid as $x) {
                            $userid = $x;

                            $sql = "INSERT INTO scan_leave (leave_id, userid, depart, leavetype_id, date,date_end,leave_save , commend,commend1, leave_beloag, leave_cotton, leave_address,leave_ass,leave_position,leave_cause)
                                     VALUES (NULL, '$userid', '$model->depart', '$model->leavetype_id', '$strStartDate','$date_end', '$model->leave_save','$model->commend','$model->commend1'
                                     ,'$leave_beloag','$leave_cotton','$leave_address','$leave_ass','$leave_position','$leave_cause')";

                            Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน


                           
                        }

                    }
                    //---------------------------------------------------------------------------------------

            }

            //บรรทึกเพื่อสงออกรายงาน
             //---------------------------------------------------------------------------------------
                    $model->leave_save = Yii::$app->session["fname"] ."  ".Yii::$app->session["lname"];
                    
                    $model->depart = Yii::$app->session["defaultdepid"];

                   

                    if (isset($model->userid)) {
                        $userid =  $model->userid;
                       

                        foreach ($userid as $x) {
                            $userid = $x;

                            $sql = "INSERT INTO scan_leave_report (leave_id, userid, depart, leavetype_id, date,date_end,leave_save , commend,commend1, leave_beloag, leave_cotton, leave_address,leave_ass,leave_position,leave_cause)
                                     VALUES (NULL, '$userid', '$model->depart', '$model->leavetype_id', '$date_strat','$date_end', '$model->leave_save','$model->commend','$model->commend1'
                                     ,'$leave_beloag','$leave_cotton','$leave_address','$leave_ass','$leave_position','$leave_cause')";

                            Yii::$app->db->createCommand($sql)->execute(); //ดึง order เพื่อให้เลข order_in_no ที่ตรงกัน

                        }

                        //$model->userid = $userid;

                }

            Yii::$app->getSession()->setFlash('alert',[
                        'body'=>'เรียบร้อย! บันทึกข้อมูลเรียบร้อย...',
                        'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(['createdepart']); 

        } else {
            return $this->render('createdepart', [
                'model' => $model,
            ]);
        }
    }


        /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){

            //$model->depart = Yii::$app->session["defaultdepid"];
            $model->status = '1';
            
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdatedepart($id){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){

            $model->status = '1';
            
            if($model->save()) {

            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'เรียบร้อย! แก้ไขข้อมูลเรียบร้อย...',
                'options'=>['class'=>'alert-success']
                ]);

                return $this->redirect(['updatedepart','id'=> $id]);
            } 

        } else {
            return $this->render('updatedepart', [
                'model' => $model,
            ]);
        }
    
    }

    /**
     * Deletes an existing Leave model.
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
     * Finds the Leave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leave::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
