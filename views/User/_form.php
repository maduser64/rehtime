<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\widgets\Typeahead;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'member_id')->textInput(['maxlength' => true])  ?>

    <?php
    echo 'หน่วยงาน';
    echo $form->field($model, 'depart_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Departments::find()->all(), 'code', 'name'),
        'language' => 'th',
        'options' => [
            'placeholder' => 'เลือก ...',
            'class' => 'form-control',
        //'multiple' => true
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false);
    ?>       

    <?php //= $form->field($model, 'position_name')->textInput(['maxlength' => true]) ?>
    <?php
    echo 'ตำแหน่ง';
    echo $form->field($model, 'position_name')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\User::find()->select('position_name')->distinct()->all(), 'position_name', 'position_name'), //find()->all(), 'code', 'name'),
        'language' => 'th',
        'options' => [
            'placeholder' => 'เลือก ...',
            'class' => 'form-control',
        //'multiple' => true
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false);
    ?>  

    <?php //= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?php
    echo 'เบอร์โทรศัพฑ์';
    echo MaskedInput::widget([
        'name' => 'input-1',
        'mask' => '(999) 999-9999'
    ]);
    ?>

    <?php //= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php  
    echo '<br>';
    echo 'Email';
    echo MaskedInput::widget([
        'name' => 'input-36',
        'clientOptions' => [
            'alias' => 'email'
        ],
    ]);
    ?>

    <?php //= $form->field($model, 'status')->textInput()  ?>

    <?php echo '<br>';//= $form->field($model, 'picture')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'level')->textInput(['maxlength' => true]) ?>
    <?php
//    $Levels = Yii::$app->session["level"];
//    //echo 'Levels:'.$Levels;
//    if ($Levels == "1") {
    ?>
    <?php
    // =
    //  $form->field($model, 'level')
    //  ->dropDownList(
    //          ArrayHelper::map(\app\models\Levels::find()->all(), 'Levels_id', 'Levels_name')
    //  )
    ?>
    <?php
    //}
    ?>

    <?php //= $form->field($model, 'password')->textarea(['rows' => 6])  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'บันทึกการแก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
