<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Scanleavereport */

$this->title = $model->leave_id;
$this->params['breadcrumbs'][] = ['label' => 'Scanleavereports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scanleavereport-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->leave_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->leave_id], [
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
            'leave_id',
            'userid',
            'depart',
            'leavetype_id',
            'date',
            'date_end',
            'leave_save',
            'status',
            'commend',
            'commend1',
            'leave_beloag',
            'leave_cotton',
            'leave_address:ntext',
            'leave_ass',
            'leave_position',
        ],
    ]) ?>

</div>
