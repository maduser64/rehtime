<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'เข้าใช้งานระบบ ระบบบริการผ้า (Washing)';
?>
<div class="panel-body">

    <h3><i class="fa fa-user"></i> เข้าใช้งานระบบ :</h3>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>",
                    'labelOptions' => ['class' => 'col-lg-3 control-label'],
                ],
            ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-3">
                        <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                    <div class="col-lg-3" align="left">
                     
                        <a href="http://webapp.intranet:88/sso/index.php?r=user/create" class="btn btn-success">สมัครใช้งานระบบ</a>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-6">
            <div class="well">
                <b><i class="fa fa-book" aria-hidden="true"></i>  วิธีเข้าใช้งานระบบ</b>
                <p class="text-success">1. ชื่อผู้ใช้งาน และรหัสผ่าน (ใช้ตัวเดียวกันกับ One User All Program)</p>
                <p class="text-danger">2. หากไม่มี ให้คลิกที่ <b class="text-primary">สมัครใช้งานระบบ</b> กรอกให้ครบถ้วน 
                แล้วติดต่อ ศูนย์คอมพิวเตอร์ เพื่อเปิดสิทธิ์ใช้งานระบบ ที่เบอร์ 2096, 8007
                </p>
            </div
        </div>

    </div>
    
</div>

