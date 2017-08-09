<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChkinoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายงาน';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="chkinout-index">
    <div class="panel-body">
        <div class="body-content">
            <div class="well">
                <div class="row">

                    <div class="col-lg-12">

                    <div align="left" ><b> <i class="fa fa-book"></i>  รายงาน แสกนลายนิ้วมือ หน่วยงาน (ออฟฟิศ Back office)</b></div>
                        <hr>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รายบุคคล', ['chkinout/create']) ?>

                    </div>
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รายแผนก', ['chkinout/createdart']) ?>

                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รวมทั้งหมด', ['chkinout/createdartall']) ?>

                    </div>
                    <div class="col-lg-6">
                        <?= Html::a('<i class="fa fa-share"></i>   รวมทั้งหมด ยอดมาสาย', ['chkinout/createdartallsay']) ?>

                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                    <br>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12">

                    <div align="left" ><b> <i class="fa fa-book"></i>  รายงาน แสกนลายนิ้วมือ หน่วยงาน (วอร์ด Front office)</b></div>
                        <hr>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รายบุคคล', ['chkinout/create_front']) ?>

                    </div>
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รายแผนก', ['chkinout/createdart_front']) ?>

                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รวมทั้งหมด', ['chkinout/createdartallfront']) ?>

                    </div>
                    <div class="col-lg-6">
                        <?= Html::a('<i class="fa fa-share"></i>   รวมทั้งหมด ยอดมาสาย', ['chkinout/createdartallsay_1']) ?>

                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <br>
                    </div>
                </div>


                <div class="row">

                    <div class="col-lg-12">

                    <div align="left" ><b> <i class="fa fa-book"></i>  รายงาน การลางาน</b></div>
                        <hr>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รายแผนก', ['chkinout/createdartleave']) ?>

                    </div>
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รวมทั้งหมด', ['chkinout/createdepartleave']) ?>

                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                    <br>
                    </div>
                </div>


                <div class="row">

                    <div class="col-lg-12">

                    <div align="left" ><b> <i class="fa fa-book"></i>  คู่มือการใช้</b></div>
                        <hr>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6"> 
                        <a href="<?= Url::to('@web/doc/rehtime_user.pdf');?>" class="alert-link" target="_blank" >

                        <i class="fa fa-share"></i> ดาวน์โหลด สำหรับ หน่วยงาน</a>

                    </div>
                    <div class="col-lg-6"> 
                       <a href="<?= Url::to('@web/doc/rehtime_admin.pdf');?>" class="alert-link" target="_blank" >

                        <i class="fa fa-share"></i> ดาวน์โหลด สำหรับ ผู้ดูแลระบบ</a>

                    </div>

                </div>

               

            </div>
        </div>
    </div>

    
</div>
