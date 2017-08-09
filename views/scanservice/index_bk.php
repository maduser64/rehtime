<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RegiterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สมาชิก';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
        
        function DateThai($strDate){
                    $strYear = date("Y",strtotime($strDate))+543;
                    $strMonth= date("n",strtotime($strDate));
                    $strDay= date("j",strtotime($strDate));
                    $strHour= date("H",strtotime($strDate));
                    $strMinute= date("i",strtotime($strDate));
                    $strSeconds= date("s",strtotime($strDate));
                    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์.","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

                    $strMonthThai=$strMonthCut[$strMonth];

                    return "$strDay $strMonthThai $strYear $strHour:$strMinute:$strSeconds";
        }
?>
    
    <!-- main area -->
    <div class="main-content">
        <div class="content-view">
            <!--/Chat panel-->
            <div class="row">
                <div class="card">
                    <div class="table-responsive">
                        <?php

                            echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'panel'=>[
                                        'before'=>''
                                ],
                                 'toolbar' =>  [
                                    [
                                        'content'=> Html::a('<i class="material-icons">add</i>เพิ่มสมาชิกใหม่</i>', 
                                            ['create'], 
                                            ['class' => 'btn btn-success btn-icon loading-demo m-r-sm m-b-sm']
                                        )

                                    ],
                                    
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


                              
                                //.........
                                'tableOptions' => ['class' => 'table table-bordered table-striped m-b-0'],

                            'columns' => [
                                ['class' => 'kartik\grid\ExpandRowColumn',
                                    'value' => function ($model, $key, $index, $column) {
                                        return GridView::ROW_COLLAPSED;
                                    },
                                    'detail' => function ($model, $key, $index, $column) {
                                        $dataProvider = new \yii\data\ActiveDataProvider([
                                            'query' => \app\models\share::find()->
                                                    where(['card' => $model->card])->
                                                    orderBy('share_id desc'),
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

                                //'id',
                                //'active_id',
                                //'starus_id',
                                [
                                    'attribute' => 'regiter_number',
                                     'options' => ['style' => 'width:7%;'],
                                 ],
                                 [
                                    'attribute' => 'card',
                                     'options' => ['style' => 'width:13%;'],
                                 ],
                                 [
                                    //'header'=>'ประเภทวัสดุ',
                                    'attribute' => 'title_id',
                                    'value' => 'title.title_name',
                                    'options' => ['style' => 'width:7%;'],
                                    'filter' => ArrayHelper::map(\app\models\Title::find()->all(), 'title_name', 'title_name'),
                                     'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                                ],
                                 [
                                    'attribute' => 'name',
                                     'options' => ['style' => 'width:10%;'],
                                 ],
                                 [
                                    'attribute' => 'last_name',
                                     'options' => ['style' => 'width:10%;'],
                                 ],
                                 [
                                    //'header'=>'ประเภทวัสดุ',
                                    'attribute' => 'position_id',
                                    'value' => 'position.position_name',
                                    'options' => ['style' => 'width:15%;'],
                                    'filter' => ArrayHelper::map(\app\models\position::find()->all(), 'position_name', 'position_name'),
                                     'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                                ],
                                [
                                    //'header'=>'ประเภทวัสดุ',
                                    'attribute' => 'dept_id',
                                    'value' => 'dept.dept_name',
                                    'options' => ['style' => 'width:20%;'],
                                    'filter' => ArrayHelper::map(\app\models\Department::find()->all(), 'dept_name', 'dept_name'),
                                     'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                                ],
                                
                                [
                                        'options' => ['style' => 'width:15%;'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'header'=>'คำสั่ง',
                                        'template' => '{print}{update}{delete}',
                                        'buttons' => [
                                            
                                             'print' => function($url, $model, $key) {
                                                    
                                                      return Html::a('<i class="material-icons">event_seat</i>', $url, ['class' => 'btn btn-info btn-sm m-r-xs','target'=>'_blank']);
                                                    
                                                
                                            },
                                                    'update' => function($url, $model, $key) {
                                                    
                                                      return Html::a('<i class="material-icons">edit</i>', $url, ['class' => 'btn btn-primary btn-sm m-r-xs']);
                                                    
                                                
                                            },
                                                    'delete' => function($url, $model, $key) {
                                                    //return Html::a('<div type="button" class="btn btn-icon-toggle"><i class="fa fa-trash-o"></i></div>',$url);

                                                    return Html::a('<div type="button" class="btn btn-danger btn-sm m-r-xs" data-toggle="tooltip" data-placement="top" data-original-title="ลบข้อมูล"><i class="fa fa-trash-o"></i></div>', $url, [

                                                                'data' => [
                                                                    'confirm' => 'คุณต้องการลบ ข้อมูล ใช่หรือไม่?',
                                                                    'method' => 'get',
                                                                ],
                                                    ]);
                                                },
                                                ]
                                            ],
                                        ],
                                    ]);
                          

                        
                          ?>
                    </div>              
                  </div>
            </div>
        </div>
           
