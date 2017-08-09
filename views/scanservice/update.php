<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Scanservice */

$this->title = 'ปรับปรุงข้อมูล: ';
$this->params['breadcrumbs'][] = ['label' => 'รายการ ผู้ดูแลหน่วยงาน', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->service_id, 'url' => ['view', 'id' => $model->service_id]];
$this->params['breadcrumbs'][] = 'ปรับปรุงข้อมูล จัดการผู้ดูแลหน่วยงาน';
?>

<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  ปรับปรุงข้อมูล จัดการผู้ดูแลหน่วยงาน </b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_formupdate', [
				'id' => $id,
				]) ?>

			</div>
		</div>
	</div>
