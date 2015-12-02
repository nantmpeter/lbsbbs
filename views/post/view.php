<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

// $this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

<article class="am-article">
  <div class="am-article-hd">
    <i class="am-icon-qrcode qrcode" data-am-modal="{target: '#my-alert'}"></i>
    <h1 class="am-article-title" style="margin-top:0"><?= Html::encode($model->title) ?></h1>
    <p class="am-article-meta"><?php echo date('Y-m-d H:i:s',$model->create_at); ?></p>
  </div>

  <div class="am-article-bd">
    <!-- <p class="am-article-lead"></p> -->
       <?php echo $model->content; ?>
  </div>
</article>
<div class="img-box">
<ul data-am-widget="gallery" class="am-gallery am-avg-lg-4" data-am-gallery="{ pureview: true }" >

      <?php $img = explode(',', $model->img); 
    if($img) {
        $img = array_filter($img);
        foreach ($img as $key => $value) {
            echo '<li>
        <div class="am-gallery-item">
            <a href="#" class="">
              <img src="'.Yii::$app->params['imgUrl'].$value.'?imageView2/1/w/750/q/50"/>
            </a>
        </div>
      </li>';
            // echo '<img src="'.Yii::$app->params['imgUrl'].$value.'?imageView2/1/w/500/q/50" />';
        }
    }
     ?>
</ul>
</div>

<?php $comments = $data->getModels(); ?>
<article class="am-comment"> <!-- 评论容器 -->
 <!--  <a href="">
    <img class="am-comment-avatar" alt=""/> 
  </a>
 -->
 <?php 
     if($comments) {
        echo '<span>评论列表</span>';
     }  
  foreach ($comments as $key => $value) { ?>
       <div class="comment-box"> <!-- 评论内容容器 -->
    <header class="am-comment-hd">
      <!--<h3 class="am-comment-title">评论标题</h3>-->
      <div class="am-comment-meta"> <!-- 评论元数据 -->
        <!-- <a href="#link-to-user" class="am-comment-author">..</a> -->
        评论于 <time datetime=""><?php echo date('m-d H:i',$value->create_at) ?></time>
      </div>
    </header>

    <div class="am-comment-bd"><?php echo $value->content ?></div> <!-- 评论内容 -->
    <div class="img-box">
    <ul data-am-widget="gallery" class="am-gallery am-avg-lg-4" data-am-gallery="{ pureview: true }" >

          <?php $img = explode(',', $value->img); 
        if($img) {
            $img = array_filter($img);
            foreach ($img as $key => $value) {
                echo '<li>
            <div class="am-gallery-item">
                <a href="#" class="">
                  <img src="'.Yii::$app->params['imgUrl'].$value.'?imageView2/1/w/750/q/50"/>
                </a>
            </div>
          </li>';
                // echo '<img src="'.Yii::$app->params['imgUrl'].$value.'?imageView2/1/w/500/q/50" />';
            }
        }
         ?>
    </ul>
    </div>
  </div>
 <?php } ?>
    <?= LinkPager::widget(['pagination' => $pages]); ?>

<?php 
    if(app\models\User::isGuest()) { ?>
    <a href="/user/login" class="am-btn am-btn-default">登陆后评论</a>
    <?php }else{
 ?>
<form class="am-form" action='/comment/create' method="post">
  <!-- <fieldset disabled> -->
    <div class="am-form-group">
    <input type="hidden" name="data[post_id]" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
       <textarea class="" rows="5" name="data[content]"></textarea>
    </div>

    <div id="container" style="position: relative;" class="form-group field-post-content required has-error">
        <a class="btn btn-default am-icon-fa-plus-square-o" id="pickfiles" href="#" style="position: relative; z-index: 1;">
            <i class="glyphicon glyphicon-plus"></i>
        </a>
            <span class='img-box'>
            </span>
            <input type="hidden" id="data-img" class="" name="data[img]" value="">

    </div>
    <button type="submit" class="am-btn am-btn-primary">评论</button>
  <!-- </fieldset> -->
</form>
<?php } ?>
</article>
</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
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
               $("#container .img-box").append('<img src="'+sourceLink+'?imageView2/1/w/100/q/30">');
               $("#data-img").val($("#data-img").val()+res.key+',');
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
<div style="display:none" class="img_cover">
    <div class="am-dimmer am-active" data-am-dimmer="" id="am-dimmer-d2qaa" style="display: block;"></div>
    <div class="am-modal am-modal-loading am-modal-no-btn am-modal-active" tabindex="-1" id="my-modal-loading" style="display: block; margin-top: -50.5px;"><div class="am-modal-dialog"><div class="am-modal-hd">上传中......</div><div class="am-modal-bd"><span class="am-icon-spinner am-icon-spin"></span></div></div></div>  
</div>
