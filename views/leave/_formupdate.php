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
/* @var $model app\models\Leave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-form">
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
                    'id' => $model->formName(),
                
                   
        ]);
    ?>
    <div class="row">
        <div class="col-lg-6"> 
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
            ]);
            ?>

        </div>
         <div class="col-lg-6">
            <?=
            $form->field($model, 'date')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่...'],
                'language' => 'th',
                'clientOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    //'format' => 'dd/mm/yyyy',
                ]
            ]);
            ?>

        </div>

        
    </div> 

    <div class="row">
        <div class="col-lg-12"> 
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
            ]);
            ?>

        </div>

       
    </div>  
     
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'leavetype_id')->radioList(
                ArrayHelper::map(\app\models\leavetype::find()->all(), 'leavetype_id', 'leavetype_name')
            );
            ?>
        </div>
    </div>  

    <?php Pjax::begin(['id' => 'branchesGridBrandAdmin']); ?>

     <div id="technician_id" >
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'commend')->textInput(['maxlength' => true,'placeholder' => 'กรอกรายละเอียด การขึ้น OT เสริม...'])->label(false) ?>
            </div>
        </div>
        
    </div>
    <!--/span-->

    <?php Pjax::end(); ?>

  

    <div class="row">
        <div class="col-lg-12"> 
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i>  บันทึก' : '<i class="fa fa-save"></i>  ปรับปรุง', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
       
        <?php ActiveForm::end(); ?>     
</div>
<?php
$this->registerJs("
  var input1 = 'input[name=\"Leave[leavetype_id]\"]';

  setHideInput(8,$(input1).val(),'#technician_id');
  $(input1).click(function(val){
    setHideInput(8,$(this).val(),'#technician_id');
  });
  

  function setHideInput(set,value,objTarget)
  {
    console.log(set+'='+value);
      if(set==value)
      {
        $(objTarget).show(500);
      }
      else
      {
        $(objTarget).hide(500);
      }
  }
");
 ?>
