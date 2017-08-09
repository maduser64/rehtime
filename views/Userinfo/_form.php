<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Userinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userinfo-form">

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
        <div class="col-lg-6">
            <?= $form->field($model, 'badgenumber')->textInput(['placeholder' => 'กรุณาใส่ รหัสลายนิ้วมือ ...']) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder' => 'กรุณาใส่ คำนาหน้า ...']) ?>
        </div>

    </div>

    <div class="row">
        

        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder' => 'กรุณาใส่ ชื่อ นามสกุล ...']) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'position')->textInput(['maxlength' => true,'placeholder' => 'กรุณาใส่ ตำแหน่ง ...']) ?>
        </div>

    </div>

    <div class="row">
        

        <div class="col-lg-6">
            <?= $form->field($model, 'beloag')->textInput(['maxlength' => true,'placeholder' => 'กรุณาใส่ สังกัด ...']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'cotton')->textInput(['maxlength' => true,'placeholder' => 'กรุณาใส่ ฝ่าย ...']) ?>
        </div>

    </div>

    <div class="row">
        

        <div class="col-lg-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true,'placeholder' => 'กรุณาใส่ ที่อยุ่ ...']) ?>
        </div>

    </div>

    <div class="row">
        

        <div class="col-lg-12">
            <?php
            $data = \app\models\Department::find()->all();

            $arr = ArrayHelper::map($data, 'deptid', 'deptname');

            // Normal select with ActiveForm & model
            echo $form->field($model, 'defaultdepid')->widget(Select2::classname(), [
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก หน่วยงาน ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-6">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i>  บันทึก' : '<i class="fa fa-save"></i>  ปรับปรุง', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
