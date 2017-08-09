<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Scanlocation */

$this->title = $model->scan_id;
$this->params['breadcrumbs'][] = ['label' => 'Scanlocations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scanlocation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'scan_id' => $model->scan_id, 'scan_ip' => $model->scan_ip], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'scan_id' => $model->scan_id, 'scan_ip' => $model->scan_ip], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'scan_id',
            'scan_ip',
            'scan_location',
            'status_id',
            'lest_update',
        ],
    ]) ?>

</div>
