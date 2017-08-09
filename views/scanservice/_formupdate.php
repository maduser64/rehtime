<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\typeahead\Typeahead;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Scanservice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scanservice-form">

	 <div class="row">
        <?php if (Yii::$app->session->hasFlash('alert')): ?>
                <?=
                \yii\bootstrap\Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),

                ])
                ?>
        <?php endif; ?>
    </div>



     <?php
        $form = ActiveForm::begin([
            //'id' => $model->formName(),
            'action' => ['update','id' => $_GET['id']],
            'method' => 'post',
        ]);
    ?>

    <div class="row">
        <div class="col-lg-10"> 

            <?php 
                
                //Scanservice::find()->select('user_id')->distinct();

            $data = \app\models\Userinfo::find()->where(['badgenumber' => $id])->all();
            

            $arr = ArrayHelper::map($data, 'badgenumber', 'name');

            // Normal select with ActiveForm & model
            ?>


            <?php
            echo Select2::widget([
                'name' => 'user_id',
                //'value' => $arr,
                'data' => $arr,
                'options' => [
                    //'placeholder' => 'กรุณาเลือก ชื่อ สกุล ...',
                    //'multiple' => true
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                    'maximumInputLength' => 10
                ],
            ]);

            // Normal select with ActiveForm & model
            // echo $form->field($model, 'user_id')->widget(Select2::classname(), [
            //     'data' => $arr,
            //     'size' => Select2::MEDIUM,
            //     'language' => 'th',
            //     'options' => ['placeholder' => 'กรุณาเลือก ชื่อ สกุล ...'],
            //     'pluginOptions' => [
            //         'allowClear' => true
            //     ],
            // ])->label(false);
            

            ?>
        </div>

        
    </div> 
    <br>
    <div class="row">
        <div class="col-md-10">
            <?php

            $data = \app\models\Scanservice::find()->where("user_id = '$id' ")->all();
            $arr = array("");

            foreach ($data as $r) {
                array_push($arr,$r['depart_id']);
            }


            $data1 = \app\models\Department::find()->all();

            //$arr1 = array("");
            // foreach ($data1 as $r) {
            //     array_push($arr1,$r['technician_name']);
            //     //array_push($arr1);
            // }

            $arr1 = ArrayHelper::map($data1, 'deptid', 'deptname');


            echo Select2::widget([
                'name' => 'depart_id',
                'value' => $arr,// initial value
                'data' => $arr1,
                'options' => [
                    'placeholder' => 'กรุณาเลือก หน่วยงาน ...',
                    'multiple' => true
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                    'maximumInputLength' => 10
                ],
            ]);

            ?>

        </div>
    </div>
    <hr>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i>  ปรับปรุง', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
