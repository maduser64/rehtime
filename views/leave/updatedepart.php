<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Leave */

$this->title = 'ปรับปรุงข้อมูลการลา : ' . $model->leave_id;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลการลา', 'url' => ['indexdepart']];
//$this->params['breadcrumbs'][] = ['label' => $model->leave_id, 'url' => ['view', 'id' => $model->leave_id]];
$this->params['breadcrumbs'][] = 'ปรับปรุงข้อมูลการลา';
?>
<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  บันทึกข้อมูล   การลา</b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_formdepart', [
				'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
