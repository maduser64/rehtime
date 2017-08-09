<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScanserviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการ ผู้ดูแลหน่วยงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">

    <div class="body-content">

        <div class="row">

            <div class="col-lg-12">
                <div class="well">
                    <div align="left" ><b> <i class="fa fa-search"></i>  ค้นหา  รายการ ผู้ดูแลหน่วยงาน</b></div>
                    <hr>
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>

            </div>
            <div class="col-lg-12">
                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'panel'=>[
                                        'before'=>''
                                ],
                                 'toolbar' =>  [
                                    
                                    '{toggleData}',
                                    '{export}'
                                ],
                                'toggleDataOptions' => [
                                    'all' => [
                                        'icon' => 'resize-full',
                                        'label' => 'ทั้งหมด',
                                        'class' => 'btn btn-primary',
                                        'title' => 'แสดงข้อมูลทั้งหมด'
                                    ],
                                    'page' => [
                                        'icon' => 'resize-small',
                                        'label' => 'แบ่งหน้า',
                                        'class' => 'btn btn-warning',
                                        'title' => 'แสดงข้อมูลแบ่งหน้า'
                                    ],

                                ],

                                'export' => [
                                        'icon' => 'glyphicon glyphicon-export',
                                        'label' => 'ส่งออก',
                                        'class' => 'btn btn-warning',
                                        'title' => 'แสดงข้อมูลแบ่งหน้า'

                        ],      
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            ['class' => 'kartik\grid\ExpandRowColumn',
                                    'value' => function ($model, $key, $index, $column) {
                                        return GridView::ROW_COLLAPSED;
                                    },
                                    'detail' => function ($model, $key, $index, $column) {
                                        $dataProvider = new \yii\data\ActiveDataProvider([
                                            'query' => \app\models\Scanservice::find()->
                                                    where(['user_id' => $model->user_id])->
                                                    orderBy('user_id desc'),
                                            'pagination' => [
                                                'pageSize' => 100,
                                            ],
                                        ]);
                                        return Yii::$app->controller->renderPartial('_poitems', [
                                                    //'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                        ]);
                                        }
                            ],
                            [
                                'attribute' => 'user_id',
                                'value' => 'user.name',
                                'options' => ['style' => 'width:70%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header'=>'คำสั่ง',
                                'template' => '{update}  {delete}',
                                'contentOptions' => [
                                    'noWrap' => true
                                ],
                                'buttons' => [
                                    'update' => function($url, $model, $key) {
                                        return Html::a('<div type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></div>',['scanservice/update','id'=>$model->user_id]);

                                        // return Html::a('<div type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></div>', $url);
                                    },

                                    'delete' => function($url, $model, $key) {
                                        return Html::a('<div type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></div>',['scanservice/delete','id'=>$model->user_id], [
                                                    'data' => [
                                                        'confirm' => 'คุณต้องการลบ ข้อมูล ใช่หรือไม่?',
                                                        'method' => 'post',
                                                    ],
                                        ]);
                                    },
                                        ]
                                    ],
                        ],
                ]); ?>

            </div>

        </div>

    </div>
</div>
