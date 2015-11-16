<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '登陆';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<a href="/user/reg" class="am-btn am-btn-warning">注册</a>
</div>