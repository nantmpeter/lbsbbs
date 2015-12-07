<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .btn-primary { width: 100%; }
    label {display: none}
</style>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'class'=>'am-form-field','placeholder'=>'输入用户名']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'class'=>'am-form-field','placeholder'=>'输入密码']) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'am-btn am-btn-primary btn-bar']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
