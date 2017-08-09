<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผู้ใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php
    //echo \app\commands\PublicsController::Head($this->title);
    ?>

    <?php
    $gridColumns = [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width: 30px;vertical-align: middle;']
        ],
        //'user_id',
        [
            'attribute' => 'username',
            'value' => 'username',
            'contentOptions' => ['style' => 'width: 5%;vertical-align: middle;']
        ],
        //'title',
        [
            'attribute' => 'title',
            'value' => 'title',
            'contentOptions' => ['style' => 'width: 10%;vertical-align: middle;']
        ],
        //'firstname',
        [
            'attribute' => 'firstname',
            'value' => 'firstname',
            'contentOptions' => ['style' => 'width: 20%;vertical-align: middle;']
        ],
        //'surname',
        [
            'attribute' => 'surname',
            'value' => 'surname',
            'contentOptions' => ['style' => 'width: 20%;vertical-align: middle;']
        ],
        //'nickname',
        [
            'attribute' => 'nickname',
            'value' => 'nickname',
            'contentOptions' => ['style' => 'width: 10%;vertical-align: middle;']
        ],
        // 'member_id',
        // 'position_name',
        [
            'attribute' => 'position_name',
            'value' => 'position_name',
            'contentOptions' => ['style' => 'vertical-align: middle;']
        ],
        // 'tel',
        // 'email:email',
        // 'status',
        // 'picture',
        // 'username',
        // 'password:ntext',
        // 'level',
//        [
//            'attribute' => 'level',
//            'value' => 'level',
//            'contentOptions' => ['style' => 'vertical-align: middle;']
//        ],
        //['class' => 'yii\grid\ActionColumn'],
        [
            'class' => 'yii\grid\ActionColumn',
            'buttonOptions' => ['class' => 'btn btn-info btn-sm'],
            'contentOptions' => ['style' => 'width: 50px;vertical-align: middle;'],
            'template' => '{update}'
        ],
//        [
//            'class' => 'yii\grid\ActionColumn',
//            'buttonOptions' => ['class' => 'btn btn-info btn-sm'],
//            'contentOptions' => ['style' => 'width: 50px;vertical-align: middle;'],
//            'template' => '{delete}'
//        ],
    ];
    ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            //'heading' => "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'><i class='glyphicon glyphicon-plus'></i>Create New</button>",
            //'heading' => "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'><i class='glyphicon glyphicon-plus'></i>Create New</button>",
            'heading' => "<a href='index.php?r=user/create'><button type='button' class='btn btn-primary'><i class='glyphicon glyphicon-plus'></i>Create New</button></a>",
            'before' => FALSE
        ],
        'summary' => \app\commands\PublicsController::ExportMenu($dataProvider, $gridColumns),
        'export' => FALSE,
        'toggleData' => FALSE,
        'columns' => $gridColumns
    ]);
    ?>
</div>
