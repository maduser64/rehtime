<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'เพิ่ม ผู้ใช้งาน';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php
    echo \app\commands\PublicsController::Head($this->title);
    ?>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
