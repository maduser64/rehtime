<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Chkinout */

$this->title = 'รายงาน  รวมทุกแผนก (วอร์ด Front office)';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['reportform']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">

    <div class="body-content">
        <div class="well">
            <div class="row">


                <div class="col-lg-12">

                    <div align="left" ><b> <i class="fa fa-file-pdf-o"></i>  รายงาน  รวมทุกแผนก (วอร์ด Front office)</b></div>
                    <hr>


                </div>

                <div class="col-lg-12">
                    <?=
                    $this->render('_formdartallsay_1', [
                        'model' => $model
                    ])
                    ?>

                </div>

            </div>

        </div>
    </div>


</div>
