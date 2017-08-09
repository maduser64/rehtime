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
            //'action' => ['updatedepart','id' => $_GET['id']],
            'method' => 'post',
        ]);
    ?>
    <div class="row">
        <div class="col-lg-6">
            
            
            <?php 
                // $datenow = date('Y-m-d');
                // $date = date("Y-m-d", strtotime($model->date_end));


                // if($date < $datenow){
                //     echo $form->field($model, 'date')->textInput(['readonly' => true]);   
                // }else{
                //     //echo $form->field($model, 'date')->textInput();
                    
                //     echo    $form->field($model, 'date')->widget(
                //                 DatePicker::className(), [
                //             'language' => 'th',
                //             'clientOptions' => [
                //                 'todayHighlight' => true,
                //                 'autoclose' => true,
                //                 'format' => 'yyyy-mm-dd',
                //                 //'format' => 'dd/mm/yyyy',
                //             ]
                //         ]);
                // }

                echo    $form->field($model, 'date')->widget(
                                DatePicker::className(), [
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

        <div class="col-lg-6">

            <?php 
                // if($date < $datenow){
                //     echo $form->field($model, 'date_end')->textInput(['readonly' => true]);   
                // }else{
                //     echo $form->field($model, 'date_end')->widget(
                //                 DatePicker::className(), [
                //             'language' => 'th',
                //             'clientOptions' => [
                //                 'todayHighlight' => true,
                //                 'autoclose' => true,
                //                 'format' => 'yyyy-mm-dd',
                //                 //'format' => 'dd/mm/yyyy',
                //             ]
                //         ]);
                // }

                echo $form->field($model, 'date_end')->widget(
                                DatePicker::className(), [
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

            $data = \app\models\Userinfo::find()->where("badgenumber = '$model->userid' ")
                    ->all();
                        
            $arr = array("");
            foreach ($data as $r) {
                    array_push($arr,$r['badgenumber']);
            }


            $data1 = \app\models\Userinfo::find()->all();

            $arr1 = ArrayHelper::map($data1, 'badgenumber', 'name');

            // Normal select with ActiveForm & model
            echo Select2::widget([
                'name' => 'userid',
                'value' => $arr,
                'data' => $arr1,
                'disabled' => true,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => [
                    //'placeholder' => 'กรุณาเลือก ชื่อ สกุล ...',
                    'multiple' => true,
        
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);

            ?>
        </div>

        
    </div> 
     
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'leavetype_id')->radioList(
                ArrayHelper::map(\app\models\leavetype::find()->asArray()->all(), 'leavetype_id', 'leavetype_name')
                ,['itemOptions' => ['disabled' => true]]
                //,['items' => ['value' => $model->leavetype_id]]
            );
            ?>
        </div>
    </div>

    <?php if($model->leavetype_id == '8') { ?>

     
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'commend')->textInput(['maxlength' => true,'placeholder' => 'กรอกรายละเอียด การขึ้น OT เสริม...'])->label(false) ?>
            </div>
        </div>
   
    <!--/span-->

    <?php } ?>

    <?php if($model->leavetype_id == '12') { ?>
     
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'commend1')->textInput(['maxlength' => true,'placeholder' => 'กรอกรายละเอียด อื่น ...'])->label(false) ?>
            </div>
        </div>
     
    <!--/span-->

    <?php } ?>

    <!--เงื่อนไขการ ลาพักผ่อน-->
    <?php if($model->leavetype_id == '3') { ?>
        <div class="row">
            <div class="col-md-12">
            <label class="control-label">ผู้ปฎิบัติหน้าที่แทน</label>

                <?php 
                    $name = Yii::$app->session["fname"];
                    $fname = Yii::$app->session["lname"];

                    $sql = "SELECT badgenumber,`name`,defaultdepid
                            FROM scan_userinfo
                            WHERE `name` LIKE '%$name%' AND `name` LIKE '%$fname%';";

                        $dataReader = Yii::$app->db->createCommand($sql)->query();

                        foreach ($dataReader as $r) {
                            Yii::$app->session["defaultdepid"] = $r['defaultdepid'];
                            $user = $r['badgenumber'];


                        }

                        $scandepart_id = Yii::$app->session["defaultdepid"];

                    ?>

                    <?php

                        $sql1 = "SELECT depart_id
                                FROM scan_service AS s
                                INNER JOIN scan_userinfo AS u ON s.user_id = u.badgenumber
                                WHERE s.user_id = '$user'; ";

                        $data1 = Yii::$app->db->createCommand($sql1)->query();

                        $coutdepart = count($data1);

                            
                    $i = 0;
                    $a = array();
                    $depart = "";
                    $depart1 = "";

                    if($coutdepart > 1){
                        foreach ($data1 as $r) {
                            $a[$i] = $r['depart_id'];
                            $i++;
                    }

                    //echo print_r($a);

                     //$data = \app\models\Userinfo::find()->where(['defaultdepid' => $a])->all();
                        $data = \app\models\Userinfo::find()
                            ->innerJoinWith('depart','depart.deptid,defaultdepid')
                            ->where(['defaultdepid' => $a])
                            ->all();

                   
                    }else{
                        //$data = \app\models\Userinfo::find()->where(['defaultdepid' => $scandepart_id])->all();
                        $data = \app\models\Userinfo::find()
                                ->innerJoinWith('depart','depart.deptid,defaultdepid')
                                ->where(['defaultdepid' => $scandepart_id])
                                ->all();
                    }

                    //$arr = ArrayHelper::map($data, 'badgenumber', 'name');
                    //สร้าง Array 2 มิติ 
                    $arr = ArrayHelper::map( $data , 'badgenumber' , 'name' , 'depart.deptname' );

                    echo $form->field($model, 'leave_ass')->widget(Select2::classname(), [
                        //'name' => 'userid',
                        'data' => $arr,
                        'value' => $model->leave_ass,
                        'options' => [
                            'placeholder' => 'ระหว่างลาขอมอบงานให้ ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true
                        ],
                    ])->label(false);

                ?>
            </div>
        </div>
        <hr>
        
    <!--/span-->

    <?php } ?>

    <!--เงื่อนไขการ ลากิจ-->
    <?php if($model->leavetype_id == '2') { ?>
        <div class="row">
            <div class="col-md-12">
                    <?php echo  $form->field($model, 'leave_cause')->textInput(['maxlength' => true,'placeholder' => 'กรอก  สาเหตุการลา ...']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <label class="control-label">ผู้ปฎิบัติหน้าที่แทน</label>

                <?php
                    $data = \app\models\Userinfo::find()->where("badgenumber = '$model->leave_ass' ")->all();
                    
                    $arr = array("");
                    foreach ($data as $r) {
                            array_push($arr,$r['badgenumber']);
                    }
                    $data1 = \app\models\Userinfo::find()->all();

                    $arr1 = ArrayHelper::map($data1, 'badgenumber', 'name');

                    echo Select2::widget([
                        'name' => 'leave_ass',
                        'value' => $arr,
                        'data' => $arr1,
                        'options' => [
                            'placeholder' => 'ผู้ปฎิบัติหน้าที่แทน ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true
                        ],
                    ]);

                    ?>
            </div>
        </div>
        <hr>
    <!--/span-->
    <?php } ?>

    <!--เงื่อนไขการ ลาป่วย-->
    <?php if($model->leavetype_id == '4') { ?>
        <div class="row">
            <div class="col-md-12">
                <!--  <input class="form-control" id="leave_cotton4" name="leave_cotton4" type="text" placeholder="กรอก สาเหตุการลา ..."> -->

                <?= $form->field($model, 'leave_cause')->textInput(['maxlength' => true,'placeholder' => 'กรอก  สาเหตุการลา ...']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <label class="control-label">ผู้ปฎิบัติหน้าที่แทน</label>

                <?php
                    $data = \app\models\Userinfo::find()->where("badgenumber = '$model->leave_ass' ")->all();
                    
                    $arr = array("");
                    foreach ($data as $r) {
                            array_push($arr,$r['badgenumber']);
                    }
                    $data1 = \app\models\Userinfo::find()->all();

                    $arr1 = ArrayHelper::map($data1, 'badgenumber', 'name');

                    echo Select2::widget([
                        'name' => 'leave_ass',
                        'value' => $arr,
                        'data' => $arr1,
                        'options' => [
                            'placeholder' => 'ผู้ปฎิบัติหน้าที่แทน ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true
                        ],
                    ]);

                    ?>
            </div>
        </div>
        <hr>
    <!--/span-->
    <?php } ?>

    <!--เงื่อนไขการ ลาคลอด-->
    <?php if($model->leavetype_id == '5') { ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'leave_cause')->textInput(['maxlength' => true,'placeholder' => 'กรอก  สาเหตุการลา ...']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">ผู้ปฎิบัติหน้าที่แทน</label>
                <?php
                    $data = \app\models\Userinfo::find()->where("badgenumber = '$model->leave_ass' ")->all();
                    
                    $arr = array("");
                    foreach ($data as $r) {
                            array_push($arr,$r['badgenumber']);
                    }
                    $data1 = \app\models\Userinfo::find()->all();

                    $arr1 = ArrayHelper::map($data1, 'badgenumber', 'name');

                    echo Select2::widget([
                        'name' => 'leave_ass',
                        'value' => $arr,
                        'data' => $arr1,
                        'options' => [
                            'placeholder' => 'ผู้ปฎิบัติหน้าที่แทน ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true
                        ],
                    ]);

                    ?>
            </div>
        </div>
        <hr>
    
    <!--/span-->
    <?php } ?>
  

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

  setHideInput(12,$(input1).val(),'#technician_id1');
  $(input1).click(function(val){
    setHideInput(12,$(this).val(),'#technician_id1');
  });

  setHideInput(3,$(input1).val(),'#technician_id3');
  $(input1).click(function(val){
    setHideInput(3,$(this).val(),'#technician_id3');
  });

  setHideInput(2,$(input1).val(),'#technician_id4');
  $(input1).click(function(val){
    setHideInput(2,$(this).val(),'#technician_id4');
  });

   setHideInput(4,$(input1).val(),'#technician_id5');
  $(input1).click(function(val){
    setHideInput(4,$(this).val(),'#technician_id5');
  });

   setHideInput(5,$(input1).val(),'#technician_id6');
  $(input1).click(function(val){
    setHideInput(5,$(this).val(),'#technician_id6');
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
