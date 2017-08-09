<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PoItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'สมาชิก | รายการหุ้น';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="po-item-index">
    

    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'summary' => '',
                            //'showPageSummary' => TRUE,
                            'columns' => [
                                ['class'=>'kartik\grid\SerialColumn'],
                                [
                                    'attribute' => 'depart_id',
                                    'value' => 'depart.deptname',
                                    'options' => ['style' => 'width:80%;'],
                                    'contentOptions' => ['style' => 'vertical-align: middle;'],
                                ],
                                    
                                // 'user_update',
                                 //'shareupdate_status',
                                //['class' => 'yii\grid\ActionColumn'],
                                
                            ],
                        ]); ?>

</div>