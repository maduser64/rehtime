<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Leave */

$this->title = ' บันทึกข้อมูลการลา';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกการลา', 'url' => ['scanleavereport/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  บันทึกข้อมูล  การลา</b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_form', [
				'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
