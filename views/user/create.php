<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */
$alert_word = '图片上传中...';
$this->title = '注册';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
