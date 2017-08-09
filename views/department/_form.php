<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">
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
    		<?= $form->field($model, 'deptname')->textInput(['placeholder' => 'กรุณาใส่ ชื่อหน่วยงาน ...']) ?>
    	</div>

    </div>


    <div class="row">
    	<div class="col-lg-6">

    	</div>

    </div>

    <div class="row">
    	<div class="col-lg-6">
    		<?php
            $data = \app\models\ScanIntime::find()->all();

            $arr = ArrayHelper::map($data, 'intime_id', 'time_A');

            // Normal select with ActiveForm & model
            echo $form->field($model, 'intime_id')->widget(Select2::classname(), [
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก ช่วงเวลา ...'],
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
