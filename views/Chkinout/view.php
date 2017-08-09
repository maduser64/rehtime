<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Chkinout */

$this->title = $model->userid;
$this->params['breadcrumbs'][] = ['label' => 'Chkinouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chkinout-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'userid' => $model->userid, 'checktime' => $model->checktime], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'userid' => $model->userid, 'checktime' => $model->checktime], [
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
            'userid',
            'checktime',
            'checktype',
        ],
    ]) ?>

</div>
