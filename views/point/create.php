<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Point */

$this->title = '新建地点';
$this->params['breadcrumbs'][] = ['label' => 'Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="point-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
