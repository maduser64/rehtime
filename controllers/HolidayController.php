<?php

namespace app\controllers;

use Yii;
use app\models\Holiday;
use app\models\HolidaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HolidayController implements the CRUD actions for Holiday model.
 */
class HolidayController extends Controller
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
     * Lists all Holiday models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HolidaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Holiday model.
     * @param integer $FisYear
     * @param string $PublicHoliday
     * @return mixed
     */
    public function actionView($FisYear, $PublicHoliday)
    {
        return $this->render('view', [
            'model' => $this->findModel($FisYear, $PublicHoliday),
        ]);
    }

    /**
     * Creates a new Holiday model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Holiday();

        if ($model->load(Yii::$app->request->post())){

            $model->FisYear = date("Y",strtotime($model->PublicHoliday));

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
     * Updates an existing Holiday model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $FisYear
     * @param string $PublicHoliday
     * @return mixed
     */
    public function actionUpdate($FisYear, $PublicHoliday)
    {
        $model = $this->findModel($FisYear, $PublicHoliday);

        //$model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){

            $model->FisYear = date("Y",strtotime($PublicHoliday));
            $model->PublicHoliday;
            if($model->save()) {

            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'เรียบร้อย! แก้ไขข้อมูลเรียบร้อย...',
                'options'=>['class'=>'alert-success']
                ]);

                return $this->redirect(['index']);
            } 

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Holiday model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $FisYear
     * @param string $PublicHoliday
     * @return mixed
     */
    public function actionDelete($FisYear, $PublicHoliday)
    {
        $this->findModel($FisYear, $PublicHoliday)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Holiday model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $FisYear
     * @param string $PublicHoliday
     * @return Holiday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($FisYear, $PublicHoliday)
    {
        if (($model = Holiday::findOne(['FisYear' => $FisYear, 'PublicHoliday' => $PublicHoliday])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
