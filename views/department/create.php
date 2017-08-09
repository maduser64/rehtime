<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = 'บันทึกข้อมูล หน่วยงาน';
$this->params['breadcrumbs'][] = ['label' => 'รายการหน่วยงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  บันทึกข้อมูล  หน่วยงาน</b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_form', [
				'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
