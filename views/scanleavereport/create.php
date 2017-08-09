<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scanleavereport */

$this->title = 'Create Scanleavereport';
$this->params['breadcrumbs'][] = ['label' => 'Scanleavereports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scanleavereport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
