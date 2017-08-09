<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\LeaveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-search">

    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>

        <?php //echo $form->field($model, 'userid') ?>

        <?php //echo  $form->field($model, 'badgenumber') ?>

        <?php // echo $form->field($model, 'name')->textInput(['placeholder' => "กรุณาใส่ ชื่อ นามสกุล ... "])->label(false);  ?>
        <div class="col-lg-4">
            <?php
            $data = \app\models\Userinfo::find()->all();

            $arr = ArrayHelper::map($data, 'badgenumber', 'name');

            // Normal select with ActiveForm & model
            echo $form->field($model, 'userid')->widget(Select2::classname(), [
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
        
        <div class="col-lg-4">
            <?php
            $data = \app\models\Department::find()->all();

            $arr = ArrayHelper::map($data, 'deptid', 'deptname');

            // Normal select with ActiveForm & model
            echo $form->field($model, 'depart')->widget(Select2::classname(), [
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก หน่วยงาน ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>

        </div>


        <div class="col-lg-4">
            <?= Html::submitButton('<i class="fa fa-search"></i>  ค้นหา', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-save"></i>   บันทึกการลา', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
