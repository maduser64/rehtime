<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ScanserviceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scanservice-search">

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
        <div class="col-lg-6">
            <?php
            $data = \app\models\Userinfo::find()->all();

            $arr = ArrayHelper::map($data, 'badgenumber', 'name');

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
        <div class="col-lg-4">
            <?= Html::submitButton('<i class="fa fa-search"></i>  ค้นหา', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-save"></i>   บันทึกผู้ดูแลใหม่', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
