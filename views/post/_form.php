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
    #img-box img {width: 45px; margin: 5px;}
</style>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class'=>'am-form-field','placeholder'=>'在此输入标题...']) ?>

    <?= $form->field($model, 'create_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>

    <?= $form->field($model, 'update_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>
    <?= $form->field($model, 'reply_at',['options'=>['style'=>'display:none']])->hiddenInput() ?>

    <!--    <?= $form->field($model, 'user_id')->textInput() ?>-->

     <!--<?= $form->field($model, 'reply_at')->textInput() ?>-->

   <?= $form->field($model, 'lat',['options'=>['style'=>'display:none']])->hiddenInput(['class'=>'lat']) ?> 
 
   <?= $form->field($model, 'lon',['options'=>['style'=>'display:none']])->hiddenInput(['class'=>'lon']) ?>

    <!-- <?= $form->field($model, 'last_reply_id')->textInput() ?> -->

    <?= $form->field($model, 'content')->textarea(['class'=>'am-form-field','placeholder'=>'在此输入内容...']) ?>


<div id="container" style="position: relative;" class="form-group field-post-content required has-error">
    <a class="btn btn-default am-icon-plus-circle am-icon-lg" id="pickfiles" href="#" style="position: relative; z-index: 1;padding-left:0;color:gray;">
        <i class="glyphicon glyphicon-plus"></i>
    </a>
        <span id='img-box'>
        </span>
        <input type="hidden" id="post-img" class="point_id" name="Post[img]" value="">

</div>
    <?php if($point) { ?>
    <div class="form-group field-post-content required has-error">
        <span class='am-icon-map-marker'></span> <?php echo $point->name ?>
        <input type="hidden" id="post-point=id" class="point_id" name="Post[point_id]" value="<?= $point->id ?>">
    </div>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' =>  'am-btn am-btn-primary btn-bar']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/position.js"></script>

<script type="text/javascript" src="/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/js/qiniu.min.js"></script>
<script type="text/javascript">
    var uploader = Qiniu.uploader({
    runtimes: 'html5,flash,html4',    //上传模式,依次退化
    browse_button: 'pickfiles',       //上传选择的点选按钮，**必需**
    uptoken_url: '/upload/token',            //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
    // downtoken_url: '/downtoken',
    // Ajax请求downToken的Url，私有空间时使用,JS-SDK将向该地址POST文件的key和domain,服务端返回的JSON必须包含`url`字段，`url`值为该文件的下载地址
    // uptoken : '<Your upload token>', //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
    unique_names: true, // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
    // save_key: true,   // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
    domain: 'http://7rflp9.com1.z0.glb.clouddn.com/',   //bucket 域名，下载资源时用到，**必需**
    get_new_uptoken: false,  //设置上传文件的时候是否每次都重新获取新的token
    container: 'container',           //上传区域DOM ID，默认是browser_button的父元素，
    max_file_size: '100mb',           //最大文件体积限制
    flash_swf_url: 'js/plupload/Moxie.swf',  //引入flash,相对路径
    max_retries: 3,                   //上传失败最大重试次数
    dragdrop: true,                   //开启可拖曳上传
    drop_element: 'container',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
    chunk_size: '4mb',                //分块上传时，每片的体积
    auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传,
    //x_vars : {
    //    自定义变量，参考http://developer.qiniu.com/docs/v6/api/overview/up/response/vars.html
    //    'time' : function(up,file) {
    //        var time = (new Date()).getTime();
              // do something with 'time'
    //        return time;
    //    },
    //    'size' : function(up,file) {
    //        var size = file.size;
              // do something with 'size'
    //        return size;
    //    }
    //},
    init: {
        'FilesAdded': function(up, files) {
            plupload.each(files, function(file) {
                // 文件添加进队列后,处理相关的事情
            });
        },
        'BeforeUpload': function(up, file) {
               // 每个文件上传前,处理相关的事情
               $('.img_cover').show();
        },
        'UploadProgress': function(up, file) {
               // 每个文件上传时,处理相关的事情
        },
        'FileUploaded': function(up, file, info) {
               // 每个文件上传成功后,处理相关的事情
               // 其中 info 是文件上传成功后，服务端返回的json，形式如
               // {
               //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
               //    "key": "gogopher.jpg"
               //  }
               // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html

               var domain = up.getOption('domain');
               var res = $.parseJSON(info);

               var sourceLink = domain + res.key; //获取上传成功后的文件的Url
               $("#img-box").append('<img src="'+sourceLink+'?imageView2/1/w/100/q/30">');
               $("#post-img").val($("#post-img").val()+res.key+',');
        },
        'Error': function(up, err, errTip) {
               //上传出错时,处理相关的事情
        },
        'UploadComplete': function() {
               $('.img_cover').hide();
               //队列文件处理完毕后,处理相关的事情
        },
        'Key': function(up, file) {
            // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
            // 该配置必须要在 unique_names: false , save_key: false 时才生效

            var key = "";
            // do something with key here
            return key
        }
    }
});
</script>