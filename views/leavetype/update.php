<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Leavetype */

$this->title = 'ปรับปรุง ประเภทการลา: ' . $model->leavetype_id;
$this->params['breadcrumbs'][] = ['label' => 'รายการประเภทการลา', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->leavetype_id, 'url' => ['view', 'id' => $model->leavetype_id]];
$this->params['breadcrumbs'][] = 'ปรับปรุง ประเภทการลา';
?>
<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  บันทึกข้อมูล </b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_form', [
				'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
