<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeavetypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประเภทการลา';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel-body">

    <div class="body-content">
        <div class="well">
            <div class="row">

                <div class="col-lg-12">

                <div align="left" ><b> <i class="fa fa-save"></i>  บันทึกข้อมูล ประเภทการลา </b></div>
                    <hr>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?= Html::a('<i class="fa fa-save"></i>   บันทึกประเภทการลา', ['create'], ['class' => 'btn btn-success']) ?>
                    <hr>
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
                            //'header'=>'ประเภทวัสดุ',
                        'attribute' => 'leavetype_name',
                        'value' => 'leavetype_name',
                        'options' => ['style' => 'width:50%;'],
                        'contentOptions' => ['style' => 'vertical-align: middle;'],
                        //'filter' => ArrayHelper::map(\app\models\Depart::find()->all(), 'code', 'name'),
                        //'contentOptions' => ['style' => 'width: 150px;vertical-align: middle;'] // <-- right here,
                        ],
                        
                        // 'leave_save',
                        // 'status',

                        [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'คำสั่ง',
                        'template' => '{pinrt} {update} {delete}',
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
