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



    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-10"> 

            <?php 
                    
                $data = \app\models\Userinfo::find()->all();
            

            $arr = ArrayHelper::map($data, 'badgenumber', 'name');

            // Normal select with ActiveForm & model
            ?>


            <?php
            // echo Select2::widget([
            //     'name' => 'user_id',
            //     //'value' => $arr,
            //     'data' => $arr,
            //     'options' => [
            //         'placeholder' => 'กรุณาเลือก ชื่อ สกุล ...',
            //         //'multiple' => true
            //     ],
            //     'pluginOptions' => [
            //         'allowClear' => true,
            //         'tags' => true,
            //         'maximumInputLength' => 10
            //     ],
            // ]);

            // Normal select with ActiveForm & model
            echo $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก ชื่อ สกุล ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            

            ?>
        </div>

        
    </div> 
    <br>
    <div class="row">
        <div class="col-md-10">
            <?php
            $data = \app\models\Department::find()->all();

            $arr = ArrayHelper::map($data, 'deptid', 'deptname');

            echo Select2::widget([
                'name' => 'depart_id',
                //'value' => $arr,
                'data' => $arr,
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
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i>  บันทึก' : '<i class="fa fa-save"></i>  ปรับปรุง', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
