<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
//use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Chkinout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chkinout-form">

    <?php $form = ActiveForm::begin([
                'action' => Url::to(['reportdartall']),
                'method' => 'get',
                'options' => [
                    'target' => '_blank',
                ]
    ]); ?>
    
    <div class="row">


        <div class="col-md-5">

            <?=
            $form->field($model, 'date_strat')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่เริ่มต้น...'],
                'language' => 'th',
                'clientOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    //'format' => 'dd/mm/yyyy',
                ]
            ])->label(false);
            ?>
        </div>

        <div class="col-md-5">
            <?=
            $form->field($model, 'date_end')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่สิ้นสุด...'],
                'language' => 'th',
                'clientOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    //'format' => 'dd/mm/yyyy',
                ]
            ])->label(false);
            ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-10" align="right">
<?= Html::submitButton('<i class="fa fa-print"></i>  ปริ้นรายงาน', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

<?php ActiveForm::end(); ?>
</div>
