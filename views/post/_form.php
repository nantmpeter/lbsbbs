<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class'=>'am-form-field','placeholder'=>'在此输入标题...']) ?>

    <?= $form->field($model, 'create_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>

    <?= $form->field($model, 'update_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>

    <!--    <?= $form->field($model, 'user_id')->textInput() ?>-->

     <!--<?= $form->field($model, 'reply_at')->textInput() ?>-->

   <?= $form->field($model, 'lat',['options'=>['style'=>'display:none']])->hiddenInput() ?> 
 
   <?= $form->field($model, 'lon',['options'=>['style'=>'display:none']])->hiddenInput() ?>

    <!-- <?= $form->field($model, 'last_reply_id')->textInput() ?> -->

    <?= $form->field($model, 'content')->textarea(['class'=>'am-form-field','placeholder'=>'在此输入内容...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        navigator.geolocation.getCurrentPosition(position);
        function position(p){
            var lat = p.coords.latitude.toString(),
                lon = p.coords.longitude.toString();
            $("#post-lat").val(lat.substr(0,10));
            $("#post-lon").val(lon.substr(0,10));
            // console.log(p.coords.latitude,p.coords.longitude);
        }
    });
</script>