<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลการแสกนลายนิ้วมือ';
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
        
        return "$strDay $strMonthThai $strYear เวลา  $strHour.$strMinute";
    }
?>

<div class="panel-body">

    <div class="body-content">

        <div class="row">

            <div class="col-lg-12">
                <div class="well">
                    <div align="left" ><b> <i class="fa fa-search"></i>  ค้นหา  ข้อมูลการแสกนลายนิ้วมือ</b></div>
                    <hr>
                    <?php echo $this->render('_searchdepart', ['model' => $searchModel]); ?>
                </div>

            </div>

            
         

            <?php if(empty($_GET['ChkinoutSearch']['userid']) AND empty($_GET['ChkinoutSearch']['checktime']) ){ ?>
                <div class="col-lg-12">
                    <div class="alert alert-dismissible alert-warning">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h4>แจ้งเตือน !</h4>
                      <p>คุณยังไม่ได้ทำการเลือก ชื่อ สกุล เพื่อค้นหาการสแกนลายนิ้วมือ ...</p>
                    </div>
                </div>

            <?php }else{ ?>
                <div class="col-lg-12">
                    <div class="alert alert-dismissible alert-info">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <h4>หมายเหตุ !</h4>
                          <p>ระบบจะทำการดึงข้อมูลการแสกนลายนิ้วมือ วันละ 2 ครั้ง คือ เวลา 02.00 น และเวลา 14.00 น</p>
                        </div>
                </div>
                <div class="col-lg-12">
                    <?=
                        GridView::widget([
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
                                //'userid',
                                [
                                    //'header'=>'หน่วยเบิก',
                                    'attribute' => 'userid',
                                    'value' => 'userValues.name',
                                    'options' => ['style' => 'width:30%;'],
                                    'contentOptions' => ['style' => 'vertical-align: middle;'] // <-- right here,
                                ],
                                [
                                    //'header'=>'ประเภทวัสดุ',
                                    'attribute' => 'scan_id_location',
                                    'value' => 'location.scan_location',
                                    'options' => ['style' => 'width:20%;'],
                                    'contentOptions' => ['style' => 'vertical-align: middle;'],
                                //'filter' => ArrayHelper::map(\app\models\Depart::find()->all(), 'code', 'name'),
                                //'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                                ],
                                [
                                    'attribute' => 'checktime',
                                    'options' => ['style' => 'width:20%;'],
                                    'contentOptions' => ['style' => 'vertical-align: middle;'],
                                    'value' => function($model){
                                            return DateThai($model->checktime).' น.';
                                        
                                    },
                                ],

                                [
                                    'attribute' => 'checktype',
                                    'options' => ['style' => 'width:20%;'],
                                    'contentOptions' => ['style' => 'vertical-align: middle;'],
                                    'format' => 'html',

                                    'value' => function($model){
                                        if($model->checktype == '0'){
                                            return "<div class=\"text-warning\"> เข้า </div>";
                                        }elseif($model->checktype == '1'){
                                            return "<div class=\"text-info\"> ออก </div>";
                                            
                                        }else{
                                            //return "แสกนผิดพลาด"; 

                                            return "<div class=\"text-danger\"> ยกเลิกใช้  ".$model->checktype ."</div>" ;       
                                        }
                                    },
                                ],
                            ],
                        ]);
                        ?>

                </div>

            <?php } ?>
        </div>

    </div>
</div>

