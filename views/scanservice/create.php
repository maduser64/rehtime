<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scanservice */

$this->title = 'บันทึกข้อมูล จัดการผู้ดูแลหน่วยงาน';
$this->params['breadcrumbs'][] = ['label' => 'รายการ ผู้ดูแลหน่วยงาน ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  บันทึกข้อมูล จัดการผู้ดูแลหน่วยงาน </b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_form', [
				'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
