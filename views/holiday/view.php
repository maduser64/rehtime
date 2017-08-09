<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Holiday */

$this->title = $model->FisYear;
$this->params['breadcrumbs'][] = ['label' => 'Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holiday-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'FisYear' => $model->FisYear, 'PublicHoliday' => $model->PublicHoliday], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'FisYear' => $model->FisYear, 'PublicHoliday' => $model->PublicHoliday], [
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
            'FisYear',
            'PublicHoliday',
            'Descripiton',
        ],
    ]) ?>

</div>
