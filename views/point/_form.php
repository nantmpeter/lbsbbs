<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Point */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .btn-primary { width: 100%; }
    label {display: none}
</style>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'am-form-field','placeholder'=>'在此输入地名...']) ?>

    <?= $form->field($model, 'create_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>

   <?= $form->field($model, 'lat',['options'=>['style'=>'display:none']])->hiddenInput(['class'=>'lat']) ?> 
 
   <?= $form->field($model, 'lon',['options'=>['style'=>'display:none']])->hiddenInput(['class'=>'lon']) ?>


    <?= $form->field($model, 'desc')->textarea(['class'=>'am-form-field','placeholder'=>'在此输入描述...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' =>  'am-btn am-btn-primary btn-bar']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/position.js"></script>