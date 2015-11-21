<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .btn-primary { width: 100%; }
    label {display: none}
</style>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class'=>'am-form-field','placeholder'=>'在此输入标题...']) ?>

    <?= $form->field($model, 'create_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>

    <?= $form->field($model, 'update_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>

    <!--    <?= $form->field($model, 'user_id')->textInput() ?>-->

     <!--<?= $form->field($model, 'reply_at')->textInput() ?>-->

   <?= $form->field($model, 'lat',['options'=>['style'=>'display:none']])->hiddenInput(['class'=>'lat']) ?> 
 
   <?= $form->field($model, 'lon',['options'=>['style'=>'display:none']])->hiddenInput(['class'=>'lon']) ?>

    <!-- <?= $form->field($model, 'last_reply_id')->textInput() ?> -->

    <?= $form->field($model, 'content')->textarea(['class'=>'am-form-field','placeholder'=>'在此输入内容...']) ?>
    <?php if($point) { ?>
    <div class="form-group field-post-content required has-error">
        <span class='am-icon-map-marker'></span> <?php echo $point->name ?>
        <input type="hidden" id="post-point=id" class="point_id" name="Post[point_id]" value="<?= $point->id ?>">
    </div>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' =>  'am-btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/position.js"></script>