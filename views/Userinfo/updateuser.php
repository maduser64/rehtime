<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = 'รายการ ชื่อผู้สแกนลายนิ้วมือ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">

    <div class="body-content">

        <div class="row">

            <div class="col-lg-12">
                <div align="left" ><b> <i class="fa fa-pencil"></i>  ปรับปรุงข้อมูลพื้นฐานบุคคล</b></div>
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
                        //'badgenumber',
                      
                        [
                            //'header'=>'ประเภทวัสดุ',
                            'attribute' => 'title',
                            'options' => ['style' => 'width:10%;'],
                            'contentOptions' => ['style' => 'vertical-align: middle;'],
                       
                        ],
                        [
                            //'header'=>'ประเภทวัสดุ',
                            'attribute' => 'name',
                            'options' => ['style' => 'width:20%;'],
                            'contentOptions' => ['style' => 'vertical-align: middle;'],
                       
                        ],
                        
                        [
                            //'header'=>'ประเภทวัสดุ',
                            'attribute' => 'position',
                            'options' => ['style' => 'width:20%;'],
                            'contentOptions' => ['style' => 'vertical-align: middle;'],
                       
                        ],
                        [
                            //'header'=>'ประเภทวัสดุ',
                            'attribute' => 'defaultdepid',
                            'value' => 'depart.deptname',
                            'options' => ['style' => 'width:30%;'],
                            'contentOptions' => ['style' => 'vertical-align: middle;'],
                       
                        ],
                         [
                                'class' => 'yii\grid\ActionColumn',
                                'header'=>'คำสั่ง',
                                'template' => '{updateuser1}',
                                'contentOptions' => [
                                    'noWrap' => true
                                ],
                                'buttons' => [
                                    'updateuser1' => function($url, $model, $key) {
                                        //return Html::button('เพิ่มประเภทงาน', ['value' => Url::to('@web/jobdetail/update/'.$model->jobdetail_id), 'class' => 'btn btn-success', 'id' => 'modalButtonCPU']);
                                        return Html::a('<div type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></div>', $url);
                                    }
                                        ]
                                    ],
                    ],
                ]);
                ?>

            </div>

        </div>

    </div>
</div>
