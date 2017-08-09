<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการหน่วยงาน';
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
        <div class="well">
            <div class="row">

                <div class="col-lg-12">
                    
                        <div align="left" ><b> <i class="fa fa-save"></i>  บันทึก  หน่วยงาน </b></div>
                        <hr>
                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
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
                                'attribute' => 'deptname',
                                'options' => ['style' => 'width:30%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                
                            ],
                            [
                                'attribute' => 'intime_id',
                                'options' => ['style' => 'width:20%;'],
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'value' => function($model){
                                    if($model->intime_id == '1'){
                                        return "08:00:00 - 16:00:00";
                                    }elseif($model->intime_id == '2'){
                                        return "08:15:00 - 16:15:00";

                                    }elseif($model->intime_id == '3'){
                                        return "08:30:00 - 16:30:00";
                                    }else{
                                        return "จัดตารางเวร";
                                    }
                                },
                            ],
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
