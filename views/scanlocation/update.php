<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Scanlocation */

$this->title = 'ปรับปรุงข้อมูลเครื่องสแกนใหม่';
$this->params['breadcrumbs'][] = ['label' => 'รายการข้อมูลเครื่องสแกน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">

	<div class="body-content">

		<div class="well">
			<div class="row">

				<div class="col-lg-12">

				<div align="left" ><b> <i class="fa fa-save"></i>  ปรับปรุง   ข้อมูลเครื่องแสกนลายนิ้วมือ </b></div>
					<hr>


				</div>
			</div>

			<?= $this->render('_form', [
				'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
