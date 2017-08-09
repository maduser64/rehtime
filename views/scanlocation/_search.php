<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ScanlocationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scanlocation-search">
    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>
       

        <div class="col-lg-4">
            <?php //echo $form->field($model, 'scan_ip')->textInput(['placeholder' => 'กรุณาเลือก ไอพี ...'])->label(false) ?>

            <?php
            $data = \app\models\Scanlocation::find()->all();

            $arr = ArrayHelper::map($data, 'scan_ip', 'scan_ip');

            // Normal select with ActiveForm & model
            echo $form->field($model, 'scan_ip')->widget(Select2::classname(), [
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก ไอพี ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>


        </div>

        <div class="col-lg-4">
            <?php //echo $form->field($model, 'scan_location')->textInput(['placeholder' => 'กรุณาเลือก สถานที่ ...'])->label(false) ?>

            <?php
            $data = \app\models\Scanlocation::find()->all();

            $arr = ArrayHelper::map($data, 'scan_location', 'scan_location');

            // Normal select with ActiveForm & model
            echo $form->field($model, 'scan_location')->widget(Select2::classname(), [
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก สถานที่ ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>


        </div>

        <div class="col-lg-4">
            <?= Html::submitButton('<i class="fa fa-search"></i>  ค้นหา', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-save"></i>   บันทึกเครื่องแสกน', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
