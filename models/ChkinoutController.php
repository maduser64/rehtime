<?php

namespace app\controllers;

use Yii;
use app\models\Chkinout;
use app\models\Report;
use app\models\ChkinoutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChkinoutController implements the CRUD actions for Chkinout model.
 */
class ChkinoutController extends Controller
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
     * Lists all Chkinout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChkinoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Lists all Chkinout models.
     * @return mixed
     */
    public function actionIndexdepart()
    {
        $searchModel = new ChkinoutSearch();
        $dataProvider = $searchModel->searchdepart(Yii::$app->request->queryParams);

        return $this->render('indexdepart', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }


    /**
     * Displays a single Chkinout model.
     * @param integer $userid
     * @param string $checktime
     * @return mixed
     */
    public function actionView($userid, $checktime)
    {
        return $this->render('view', [
            'model' => $this->findModel($userid, $checktime),
            ]);
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('create', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_front()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('create_front', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_frontdepart()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('create_frontdepart', [
                'model' => $model,
                ]);
        }
    }


    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedart()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdart', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedartleave()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdartleave', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedepart()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdepart', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedepartleave()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdepartleave', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedepart_front()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdepart_front', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedepart_frontdepart()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdepart_frontdepart', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedart_front()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdart_front', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedart_frontdepart()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdepart_frontdepart', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedartall()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdartall', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedartallfront()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdartallfront', [
                'model' => $model,
                ]);
        }
    }


    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatedartdepart()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('createdartdepart', [
                'model' => $model,
                ]);
        }
    }
    
    
    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUser()
    {
        $model = new Chkinout();
        
        return $this->render('create', [
            'model' => $model
            ]);
        
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionReportform()
    {
        
        return $this->render('_fromreport');
        
    }

    /**
     * Creates a new Chkinout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionReportformdepart()
    {
        
        return $this->render('_fromreportdepart');
        
    }


    public function actionReport(){

        $userid = $_GET['Report']['userid'];
        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'report'; //file name

        return $this->renderPartial($pdf, [
            'userid' => $userid,
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }

    public function actionReportfront(){

        $userid = $_GET['Report']['userid'];
        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'reportfront'; //file name

        return $this->renderPartial($pdf, [
            'userid' => $userid,
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }

    public function actionReportdart(){

        $userid = $_GET['Report']['userid'];
        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'reportdart'; //file name

        return $this->renderPartial($pdf, [
            'userid' => $userid,
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }

    public function actionReportdartleave(){

        $userid = $_GET['Report']['userid'];
        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'reportdartleave'; //file name

        return $this->renderPartial($pdf, [
            'userid' => $userid,
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }


    public function actionReportdartfront(){

        $userid = $_GET['Report']['userid'];
        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'reportdartfront'; //file name

        return $this->renderPartial($pdf, [
            'userid' => $userid,
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }

    public function actionReportdartall(){

        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'reportdartall'; //file name

        return $this->renderPartial($pdf, [
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }

    public function actionReportdartallleave(){

        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'reportdartallleave'; //file name

        return $this->renderPartial($pdf, [
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }

    public function actionReportdartallfront(){

        $date_strat = $_GET['Report']['date_strat'];
        $date_end = $_GET['Report']['date_end'];

        //echo $userid.'<br>'.$date_strat.'<br>'.$date_end;

        $pdf = 'reportdartallfront'; //file name

        return $this->renderPartial($pdf, [
            'date_strat' => $date_strat,
            'date_end' => $date_end
            ]);
    }

    /**
     * Updates an existing Chkinout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $userid
     * @param string $checktime
     * @return mixed
     */
    public function actionUpdate($userid, $checktime)
    {
        $model = $this->findModel($userid, $checktime);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'checktime' => $model->checktime]);
        } else {
            return $this->render('update', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Deletes an existing Chkinout model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $userid
     * @param string $checktime
     * @return mixed
     */
    public function actionDelete($userid, $checktime)
    {
        $this->findModel($userid, $checktime)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chkinout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $userid
     * @param string $checktime
     * @return Chkinout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($userid, $checktime)
    {
        if (($model = Chkinout::findOne(['userid' => $userid, 'checktime' => $checktime])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
