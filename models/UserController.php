<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            // มีการส่งซื่อมาจากการเลือกข้อมูล
            //$_name = $model->member_id;
            //echo $position_name;
            //$model->member_id = $this->getMemberId($_name);
            $model->password = md5("carsys12348" . $model->password);
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            // มีการส่งซื่อมาจากการเลือกข้อมูล
            //$_name = $model->member_id;
            //echo $position_name;
            //$model->member_id = $this->getMemberId($_name);
            if (!empty($model->password)) {
                $model->password = md5("carsys12348" . $model->password);
            } else {
                $model->password = Yii::$app->session["Password"];
            }

            $model->save();
            
        } else {
            Yii::$app->session["Password"] = $model->password;
            $model->password = "";
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

//    public function getMemberId($member_name) {
//        if (($re_id = \app\models\Member::findOne(['member_name' => $member_name])) !== null) {
//            return (string) $re_id->member_id;
//        } else {
//            return null;
//        }
//    }

    public function getMemberName($member_id) {
        if (($model = \app\models\Member::findOne(['member_id' => $member_id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    public function getUser($username, $password) {
        if (($model = \app\models\User::findOne(['Username' => $username, 'Password' => $password])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    public function actionLogin() {

        $model = new User();
        $session = Yii::$app->session;

        $session['Username'] = Yii::$app->session["appuser"];
        $session['Password'] = Yii::$app->session["apppwd"];
        $session['level'] = Yii::$app->session["applevel"];
        $session['app'] = Yii::$app->session["app"];

        if($session['Username'] != ""){
            
            $sql = "SELECT a.app_level_id, u.firstname,u.surname,u.depart_id
                    FROM sso_userapp a 
                    INNER JOIN sso_user u ON a.user_id=u.id
                    WHERE u.username='" . $session['Username'] . "'
                    and app_id='24';";

            $data = Yii::$app->db->createCommand($sql)->query();


            foreach ($data as $r) {
                Yii::$app->session["fname"] = $r['firstname'];
                Yii::$app->session["lname"] = $r['surname'];
                Yii::$app->session["member_id"] = $r['depart_id'];
                Yii::$app->session["level"] = $r['app_level_id'];              
                    
            }

            $dep = $this->getDepName(Yii::$app->session["member_id"]);

            if (!empty($dep)) {
                Yii::$app->session["member_name"] = $dep->name;
            } else {
                Yii::$app->session["member_name"] = 'ผู้ดูแลระบบ';
            }

            

            if(Yii::$app->session["level"] == 6){ //ระดับผู้บริหาร เลเวล 6
             return $this->redirect('@web/site/index');
            }elseif(Yii::$app->session["level"] == 5){ //ระดับผู้ดูแลระบบ เลเวล 5
                return $this->redirect('@web/site/index');
            }elseif(Yii::$app->session["level"] == 1){ //ระดับผู้ดูแลระบบ เลเวล 0
                return $this->redirect('@web/chkinout/indexdepart');
            }else{ //ระดับผู้ดูแลระบบ เลเวล 0
                return $this->redirect('@web/chkinout/indexdepart');
            }
        }

        //$this->layout = "main-login";
        if ($model->load(Yii::$app->request->post())) {
            //echo 'login';            exit();
            $Username = $model->username;
            $Password = $model->password;

            //echo 'User_id:' . $User_id .'/Password:'. $Password.'/stock_id:'.$Stock_id;
            if (!empty($Username) && !empty($Password)) {
                //echo '<br>' . $User_id . md5($Password);
                $modelres = $this->getUser($Username, md5("carsys12348" . $Password));
                //print_r($modelres);exit();
                if (!empty($modelres)) {
                    // login Ok
                    Yii::$app->session["user_id"] = $modelres->id;
                    Yii::$app->session["Username"] = $modelres->username;
                    Yii::$app->session["Password"] = $modelres->password;
                    Yii::$app->session["fname"] = $modelres->firstname;
                    Yii::$app->session["lname"] = $modelres->surname;
                    Yii::$app->session["member_id"] = $modelres->depart_id;
                    
                    //member_id; แปลงจากรหัสเป็นชื่อ                    
                    $dep = $this->getDepName(Yii::$app->session["member_id"]);

                    if (!empty($dep)) {
                        Yii::$app->session["member_name"] = $dep->name;
                    } else {
                        Yii::$app->session["member_name"] = 'ผู้ดูแลระบบ';
                    }

                    // Level App
                    $sql = "SELECT a.app_level_id FROM sso_userapp a
                            INNER JOIN sso_user u ON a.user_id=u.id
                            WHERE u.username='" . $Username . "'
                            and app_id='24';";

                    $dataReader = Yii::$app->db->createCommand($sql)->query();
                    foreach ($dataReader as $r) {
                        $applevel = $r['app_level_id'];
                    }

                    if (empty($applevel)) {
                        $applevel = "0";
                    }

                    $Username = Yii::$app->session["Username"];

                    
                    if ($applevel == '5') {
                        Yii::$app->session["level"] = '5';
                        //Yii::$app->session["member_id"] = '';
                         return $this->redirect('@web/site/index');

                    } else if ($applevel == '6') {
                        Yii::$app->session["level"] = '6';
                        //Yii::$app->session["member_id"] = '';
                         return $this->redirect('@web/site/index');

                    }else {
                        Yii::$app->session["level"] = '0';

                         return $this->redirect('@web/chkinout/indexdepart');
                    }

                } else {
                    $message = "ไม่สามารถเข้าใช้งานได้เนื่องจากการล็อกอินไม่ถูกต้อง";
                    echo "<script type='text/javascript'>";
                    echo "alert('$message');";
                    echo "window.location='login'";
                    echo "</script>";
                    echo '';
                }
            } else {
                $message = "ไม่สามารถเข้าใช้งานได้เนื่องจากการล็อกอินไม่ถูกต้อง";
                echo "<script type='text/javascript'>";
                echo "alert('$message');";
                echo "window.location='login'";
                echo "</script>";
                echo '';
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_login', [
                        'model' => $model,
            ]);
        }
    }

    public function getDepName($dep_id) {
        if (($model = \app\models\Depart::findOne(['code' => $dep_id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    public function actionLogout() {
        # Save log ---->                        
        //$comment = 'logout system';
        //\app\commands\SavelogController::Save($comment);

        Yii::$app->session["Username"] = "";
        Yii::$app->session["Password"] = "";
        Yii::$app->session["member_id"] = "";
        Yii::$app->session["level"] = "";
        Yii::$app->session["fname"]  = ""; 
        Yii::$app->session["lname"] = "";
        Yii::$app->session["member_name"] = "";
        Yii::$app->session["defaultdepid"] = "";
        
        //echo 'logout';
        return $this->redirect('login');
    }

    public function actionRegister() {
        $model = new User();
        //$this->layout = "main-login";
        $model->username = '';
        if ($model->load(Yii::$app->request->post())) {

            // มีการส่งซื่อมาจากการเลือกข้อมูล
            $_name = $model->member_id;
            //echo $position_name;
            $model->member_id = $this->getMemberId($_name);

            $model->save();

            return $this->redirect(['login']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

}
