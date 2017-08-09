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
            <?=
            $form->field($model, 'date')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่เริ่มต้น...'],
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
            <?=
            $form->field($model, 'status')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่สิ้นสุด...'],
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

            // Normal select with ActiveForm & model
            ?>


            <?php
            // echo Select2::widget([
            //     'name' => 'userid',
            //     //'value' => $arr,
            //     'data' => $arr,
            //     'options' => [
            //         'placeholder' => 'กรุณาเลือก ชื่อ สกุล ...',
            //         'multiple' => true
            //     ],
            //     'pluginOptions' => [
            //         'allowClear' => true,
            //         'tags' => true,
            //         'maximumInputLength' => 10
            //     ],
            // ]);

            echo $form->field($model, 'userid')->widget(Select2::classname(), [
                //'name' => 'userid',
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => [
                    'placeholder' => 'กรุณาเลือก ชื่อ สกุล ...',
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

    <?php Pjax::begin(['id' => 'branchesGridBrandAdmin']); ?>
     <div id="technician_id1" >
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'commend1')->textInput(['maxlength' => true,'placeholder' => 'กรอกรายละเอียด อื่น ...'])->label(false) ?>
            </div>
        </div>
        
    </div>
    <!--/span-->

    <?php Pjax::end(); ?>


     <?php Pjax::begin(['id' => 'branchesGridBrandAdmin']); ?>
     <div id="technician_id3" >
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" id="leave_beloag3" name="leave_beloag3" type="text" placeholder="กรอก สังกัด ...">

                <?php //echo  $form->field($model, 'leave_beloag')->textInput(['maxlength' => true,'placeholder' => 'กรอก สังกัด ...'])->label(false) ?>
            </div>
            <div class="col-md-6">
                <input class="form-control" id="leave_cotton3" name="leave_cotton3" type="text" placeholder="กรอก ฝ่าย ...">

                <?php //echo  $form->field($model, 'leave_cotton')->textInput(['maxlength' => true,'placeholder' => 'กรอก ฝ่าย ...'])->label(false) ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" id="leave_position3" name="leave_position3" type="text" placeholder="กรอก ตำแหน่ง ...">

                <?//= $form->field($model, 'leave_position')->textInput(['maxlength' => true,'placeholder' => 'กรอก ตำแหน่ง ...'])->label(false) ?>
            </div>
            <div class="col-md-6">

            
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


                    echo Select2::widget([
                        'name' => 'leave_ass3',
                        //'value' => $arr,
                        'data' => $arr,
                        'options' => [
                            'placeholder' => 'ระหว่างลาขอมอบงานให้ ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true
                        ],
                    ]);

                    ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                 <input class="form-control" id="leave_address3" name="leave_address3" type="text" placeholder="กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...">

                <?//= $form->field($model, 'leave_address')->textInput(['maxlength' => true,'placeholder' => 'กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...'])->label(false) ?>
            </div>
        </div>
        

        <hr>
        
    </div>
    <!--/span-->

    <?php Pjax::end(); ?>


    <?php Pjax::begin(['id' => 'branchesGridBrandAdmin']); ?>
     <div id="technician_id4" >
        <div class="row">
            <div class="col-md-6">

                <input class="form-control" id="leave_position2" name="leave_position2" type="text" placeholder="กรอก ตำแหน่ง ...">

                <?php //echo $form->field($model, 'leave_position1')->textInput(['maxlength' => true,'placeholder' => 'กรอก ตำแหน่ง ...'])->label(false) ?>
            </div>

            <div class="col-md-6">

                <input class="form-control" id="leave_beloag2" name="leave_beloag2" type="text" placeholder="กรอก สังกัด ...">

                <?php //echo  $form->field($model, 'leave_beloag')->textInput(['maxlength' => true,'placeholder' => 'กรอก สังกัด ...'])->label(false) ?>
            </div>
            
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" id="leave_cause2" name="leave_cause2" type="text" placeholder="กรอก สาเหตุการลา ...">

                    <?php //echo  $form->field($model, 'leave_cotton')->textInput(['maxlength' => true,'placeholder' => 'กรอก  สาเหตุการลา ...'])->label(false) ?>
            </div>

            <div class="col-md-6">

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


                    echo Select2::widget([
                        'name' => 'leave_ass',
                        //'value' => $arr,
                        'data' => $arr,
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
        <br>
        <div class="row">
            <div class="col-md-12">
                <input class="form-control" id="leave_address2" name="leave_address2" type="text" placeholder="กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...">

                <?php //echo  $form->field($model, 'leave_address')->textInput(['maxlength' => true,'placeholder' => 'กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...'])->label(false) ?>
            </div>
        </div>
        <hr>
        
    </div>
    <!--/span-->
    <?php Pjax::end(); ?>

    <?php Pjax::begin(['id' => 'branchesGridBrandAdmin']); ?>
     <div id="technician_id5" >
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" id="leave_position4" name="leave_position4" type="text" placeholder="กรอก ตำแหน่ง ...">

                <?//= $form->field($model, 'leave_position')->textInput(['maxlength' => true,'placeholder' => 'กรอก ตำแหน่ง ...'])->label(false) ?>
            </div>

            <div class="col-md-6">
                <input class="form-control" id="leave_beloag4" name="leave_beloag4" type="text" placeholder="กรอก สังกัด ...">

                <?//= $form->field($model, 'leave_beloag')->textInput(['maxlength' => true,'placeholder' => 'กรอก สังกัด ...'])->label(false) ?>
            </div>
            
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                 <input class="form-control" id="leave_cause4" name="leave_cause4" type="text" placeholder="กรอก สาเหตุการลา ...">

                    <?//= $form->field($model, 'leave_cotton')->textInput(['maxlength' => true,'placeholder' => 'กรอก  สาเหตุการลา ...'])->label(false) ?>
            </div>

            <div class="col-md-6">

            
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


                    echo Select2::widget([
                        'name' => 'leave_ass1',
                        //'value' => $arr,
                        'data' => $arr,
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
        <br>
        <div class="row">
            <div class="col-md-12">
                <input class="form-control" id="leave_address4" name="leave_address4" type="text" placeholder="กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...">

                <?//= $form->field($model, 'leave_address')->textInput(['maxlength' => true,'placeholder' => 'กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...'])->label(false) ?>
            </div>
        </div>
        

        
        <hr>
        
    </div>
    <!--/span-->
    <?php Pjax::end(); ?>

    <?php Pjax::begin(['id' => 'branchesGridBrandAdmin']); ?>
     <div id="technician_id6" >
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" id="leave_position5" name="leave_position5" type="text" placeholder="กรอก ตำแหน่ง ...">

                <?//= $form->field($model, 'leave_position')->textInput(['maxlength' => true,'placeholder' => 'กรอก ตำแหน่ง ...'])->label(false) ?>
            </div>

            <div class="col-md-6">
                <input class="form-control" id="leave_beloag5" name="leave_beloag5" type="text" placeholder="กรอก สังกัด ...">

                <?//= $form->field($model, 'leave_beloag')->textInput(['maxlength' => true,'placeholder' => 'กรอก สังกัด ...'])->label(false) ?>
            </div>
            
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" id="leave_cotton5" name="leave_cotton5" type="text" placeholder="กรอก สังกัด ...">

                <?//= $form->field($model, 'leave_cotton')->textInput(['maxlength' => true,'placeholder' => 'กรอก  สาเหตุการลา ...'])->label(false) ?>
            </div>

            <div class="col-md-6">

            
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
                


                    echo Select2::widget([
                        'name' => 'leave_ass2',
                        //'value' => $arr,
                        'data' => $arr,
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
        <br>
        <div class="row">
            <div class="col-md-12">
                <input class="form-control" id="leave_cause5" name="leave_cause5" type="text" placeholder="กรอก สาเหตุการลา ...">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <input class="form-control" id="leave_address5" name="leave_address5" type="text" placeholder="กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...">

                <?//= $form->field($model, 'leave_address')->textInput(['maxlength' => true,'placeholder' => 'กรอก ระหว่างลาจะติดต่อได้ที่บ้านเลขที่ ...'])->label(false) ?>
            </div>
        </div>
        <hr>
        
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
