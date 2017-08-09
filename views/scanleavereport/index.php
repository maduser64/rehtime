<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' บันทึกการลา';
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
        
        return "$strDay $strMonthThai $strYear";
    }
?>

<div class="panel-body">

    <div class="body-content">

        <div class="row">

            <div class="col-lg-12">
                <div class="well">
                    <div align="left" ><b> <i class="fa fa-search"></i>  ค้นหา  ชื่อ สกุล </b></div>
                    <hr>
                    <?php echo $this->render('_search', ['model' => $searchModel]);  echo Yii::$app->session["member_name"]; ?>
                </div>
            </div>
        </div>
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

                            //'leave_id',
                            //'userid',
                            [
                                'attribute' => 'date',
                                'options' => ['style' => 'width:10%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'value' => function($model){
                                    return DateThai($model->date);
                                },
                            ],
                            [
                                'attribute' => 'date_end',
                                'options' => ['style' => 'width:10%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'value' => function($model){
                                    return DateThai($model->date_end);
                                },
                            ],

                            [
                                //'header'=>'ประเภทวัสดุ',
                                'attribute' => 'userid',
                                'value' => 'user.name',
                                'options' => ['style' => 'width:20%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                            //'filter' => ArrayHelper::map(\app\models\Depart::find()->all(), 'code', 'name'),
                            //'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                            ],
                            [
                                //'header'=>'ประเภทวัสดุ',
                                'attribute' => 'depart',
                                'value' => 'depart1.deptname',
                                'options' => ['style' => 'width:30%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                            //'filter' => ArrayHelper::map(\app\models\Depart::find()->all(), 'code', 'name'),
                            //'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                            ],
                            [
                                //'header'=>'ประเภทวัสดุ',
                                'attribute' => 'leavetype_id',
                                'value' => 'leave.leavetype_name',
                                'options' => ['style' => 'width:20%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                            //'filter' => ArrayHelper::map(\app\models\Depart::find()->all(), 'code', 'name'),
                            //'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                            ],
                            
                            // 'leave_save',
                            // 'status',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header'=>'คำสั่ง',
                                'template' => '{leave/print}  {update} {delete}',
                                'contentOptions' => [
                                    'noWrap' => true
                                ],
                                'buttons' => [
                                    'leave/print' => function($url, $model, $key) {

                                        if($model->leavetype_id == '3'){
                                            return Html::a('<div type="button" class="btn btn-info"><i class="fa fa-print"></i></div>', $url, ['target'=>'_blank']);
                                        }else if($model->leavetype_id == '2'){
                                            return Html::a('<div type="button" class="btn btn-info"><i class="fa fa-print"></i></div>', $url, ['target'=>'_blank']);
                                        }else if($model->leavetype_id == '4'){
                                            return Html::a('<div type="button" class="btn btn-info"><i class="fa fa-print"></i></div>', $url, ['target'=>'_blank']);
                                        }else if($model->leavetype_id == '5'){
                                            return Html::a('<div type="button" class="btn btn-info"><i class="fa fa-print"></i></div>', $url, ['target'=>'_blank']);
                                        }
                                        else{
                                            return Html::a('<div type="button" class="btn btn-info disabled"><i class="fa fa-print"></i></div>');
                                        }
                                        
                                    },
                                    'update' => function($url, $model, $key) {
                                        //return Html::button('เพิ่มประเภทงาน', ['value' => Url::to('@web/jobdetail/update/'.$model->jobdetail_id), 'class' => 'btn btn-success', 'id' => 'modalButtonCPU']);
                                        return Html::a('<div type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></div>', $url);
                                    },
                                    'delete' => function($url, $model, $key) {

                                        $sql ="SELECT DISTINCT i.time_A FROM scan_userinfo u
                                            LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
                                            LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
                                            where u.defaultdepid ='$model->depart';";

                                        $rw = Yii::$app->db->createCommand($sql)->queryAll();

                                        foreach ($rw as $r){
                                            $time = $r['time_A'];
                                        }

                                        if($time == '00:00:00'){

                                            return Html::a('<div type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></div>', $url, [
                                                'data' => [
                                                    'confirm' => 'คุณต้องการลบ ข้อมูล ใช่หรือไม่?',
                                                    'method' => 'post',
                                                ],
                                            ]);
                                        }
                                    }
                                ]
                            ],
                        ],
                    ]); ?>

                </div>

            </div>

    </div>
</div>
