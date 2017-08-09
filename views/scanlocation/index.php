<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScanlocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลเครื่องสแกน';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    function DateThai($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        
        return "$strDay $strMonthThai $strYear เวลาดึงข้อมูล $strHour.$strMinute";
    }
?>

<div class="panel-body">

    <div class="body-content">
        <div class="well">
            <div class="row">

                <div class="col-lg-12">
                    
                        <div align="left" ><b> <i class="fa fa-map-marker"></i>  จัดการ เครื่องแสกนลายนิ้วมือ</b></div>
                        <hr>
                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    
                </div>
            </div>
            <hr>
              
            <div class="row">
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
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'scan_ip',
                                'options' => ['style' => 'width:20%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                            ],

                            [
                                //'header'=>'ประเภทวัสดุ',
                                'attribute' => 'scan_location',
                                'options' => ['style' => 'width:30%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                            //'filter' => ArrayHelper::map(\app\models\Depart::find()->all(), 'code', 'name'),
                            //'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                            ],
                            [
                                'attribute' => 'last_update',
                                'options' => ['style' => 'width:20%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'value' => function($model){
                                        return DateThai($model->last_update).' น.';
                                    
                                },
                            ],
                            [
                                'attribute' => 'status_id',
                                'options' => ['style' => 'width:10%;'],
                                'format' => 'html',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'value' => function($model){
                                        if($model->status_id == '0'){
                                            //return "<div class=\"btn btn-block ink-reaction btn-flat btn-danger\">";
                                            return "<div class=\"text-danger\"> ยกเลิกใช้ </div>";
                                        }else{
                                            return "<div class=\"text-success\"> เปิดใช้งาน </div>";
                                            
                                        }
                                },
                            ],
                            
                            // 'leave_save',
                            // 'status',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header'=>'คำสั่ง',
                                'template' => '{update} {delete}',
                                'contentOptions' => [
                                    'noWrap' => true
                                ],
                                'buttons' => [
                                    'view' => function($url, $model, $key) {
                                        //return Html::button('เพิ่มประเภทงาน', ['value' => Url::to('@web/jobdetail/update/'.$model->jobdetail_id), 'class' => 'btn btn-success', 'id' => 'modalButtonCPU']);
                                        return Html::a('<div type="button" class="btn btn-info"><i class="fa fa-eye"></i></div>', $url);
                                    },
                                    'update' => function($url, $model, $key) {
                                        //return Html::button('เพิ่มประเภทงาน', ['value' => Url::to('@web/jobdetail/update/'.$model->jobdetail_id), 'class' => 'btn btn-success', 'id' => 'modalButtonCPU']);
                                        return Html::a('<div type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></div>', $url);
                                    },
                                    'delete' => function($url, $model, $key) {
                                        return Html::a('<div type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></div>', $url, [
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
</div>
