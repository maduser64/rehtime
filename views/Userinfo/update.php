<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Userinfo */

$this->title = 'ปรับปรุง ชื่อผู้สแกนลายนิ้วมือ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รายการรายชื่อผู้สแกนลายนิ้วมือ', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ปรับปรุง ชื่อผู้สแกนลายนิ้วมือ';
?>
<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  บันทึกข้อมูล   ผู้แสกนลายนิ้วมือ </b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_form', [
				'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
