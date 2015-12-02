<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="m js cssanimations">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
    body {
        padding-bottom: 25px;
    }
    footer {
        position: fixed;
        bottom: 0;
        color: green;
    }
    .main-header {    
        z-index: 100;
        background: #0e90d2;
        color: #FFF;    
        position: relative;    
        box-shadow: 0 0 3px rgba(0,0,0,.15);
        font-size: 1.6rem;
        height: 45px;
        padding: 5px;
    }
    .main-header h1 {
        text-align: center;
        margin-top: 0;
    }
    #btn-back,#btn-home {
        position: absolute;
        margin-top: 6px;
    }
    .main-post {
        float: right;
        position: absolute;
        right: 10px;
    }
    #main-box {
        padding: 10px;
    }
    #btn-location,.share {
        float: right;
        display: block;
        position: absolute;
        right: 60px;
        width: 30px;
        margin-top: 5px;
        height: 30px;
    }
    .main-header{
        background-color: whitesmoke;
        color: gray;
    }
    .main-header h1{margin-top: 5px;}
    .am-btn {width: 100%}
    a:visited,a:hover { text-decoration: none;}
    </style>
    <style type="text/css">
    .am-comment {
        margin-top: 20px;
    }
    .qrcode {
        float: right;
        color: gray;
    }
    .am-btn-primary {
        width: 100%;
    }
    #img-box img{
        width: 100%;
        margin-top: 10px;
    }
    .img-box img {width: 45px; margin: 5px;}

</style>
</head>
<body>

<?php $this->beginBody() ?>
<div class="am-page" id="mobile-index">
<header class="main-header">
<?php if($this->context->id == 'point' && $this->context->module->requestedAction->id == 'index') { ?>
<?= Html::a('添加', ['/point/create'], ['class' => 'btn btn-success main-post']) ?>
<?php }else { ?>
<a class="btn btn-success main-post" href="/post/create<?php if($this->context->id == 'point' && $this->context->module->requestedAction->id == 'view') { echo '?point='.$this->context->actionParams['id']; } ?>">发帖</a>
<?php } ?>
<?php if($this->title != '' && $this->context->id != 'point') { ?>
<span class="am-icon-chevron-left" id="btn-back"></span><span class='am-icon-location-arrow' id='btn-location'></span>
<?php }else{ ?>
<span class="am-icon-home am-icon-sm" id="btn-home"></span><span class='am-icon-share-alt share' data-am-modal="{target: '#my-actions'}"></span>
<?php } ?> 
<h1><?= Html::encode($this->title) ?></h1></header>
<!-- <form action='/user/logout' method="post">
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
    <button type="submit">logout</button>
</form> -->
<script type="text/javascript" src="/js/jquery.min.js"></script>
        <div id="main-box">
            <?= $content ?>        
        </div>
</div>

<div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">问题反馈</div>
    <div class="am-modal-bd">
      来来来，吐槽点啥吧，如果你希望得到我的回复，请在反馈中写上您的联系方式，O(∩_∩)O谢谢！！
      <textarea class="am-modal-prompt-input" style="width:100%;height:200px"></textarea>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
    </div>
  </div>
</div>
<?php $this->endBody() ?>

<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
    <div id="code" style="padding: 15%;"></div>
  </div>
</div>

<div class="am-modal-actions" id="my-actions">
  <div class="am-modal-actions-group">
    <ul class="am-list">
      <li class="am-modal-actions-header" data-am-modal="{target: '#my-alert'}"><i class="am-icon-qrcode qrcode" style='float:inherit'></i> 二维码</li>
      <!-- <li><a href="#"><span class="am-icon-wechat"></span> ...</a></li>
      <li class="am-modal-actions-danger">
        <a href="#"><i class="am-icon-twitter"></i> ...</a>
      </li> -->
    </ul>
  </div>
  <div class="am-modal-actions-group">
    <button class="am-btn am-btn-secondary am-btn-block" data-am-modal-close>取消</button>
  </div>
</div>

<footer><i class='am-icon-question-circle am-icon-md feedback'></i></footer>
</body>
<script type="text/javascript">
    $(function(){
        $("#btn-back").click(function(){
            history.go(-1);
        });

        $("#btn-location").click(function(){
            location.href = '/';
        });
        $("#btn-home").click(function(){
            var url = '/';
            if(localStorage.lat)
                url += '?lat='+localStorage.lat+'&lon='+localStorage.lon;
            location.href = url;
        });
        $(".feedback").click(function(){
            $('#my-prompt').modal({
              relatedTarget: this,
              onConfirm: function(e) {
                $.post('/feedback/create',{'Feedback[content]':e.data,'_csrf':'<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>'},function(msg){
                    alert('感谢你的反馈！');
                });
              },
              onCancel: function(e) {
                alert('不想说!');
              }
            });
        });
    });
</script>
<script type="text/javascript" src="/js/jquery.qrcode.min.js"></script>
<script type="text/javascript">
    $(function(){
    var str = window.location.href;
    $('#code').qrcode({width:150,height:150,text:str});
})
function toUtf8(str) {   
    var out, i, len, c;   
    out = "";   
    len = str.length;   
    for(i = 0; i < len; i++) {   
        c = str.charCodeAt(i);   
        if ((c >= 0x0001) && (c <= 0x007F)) {   
            out += str.charAt(i);   
        } else if (c > 0x07FF) {   
            out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));   
            out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));   
            out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));   
        } else {   
            out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));   
            out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));   
        }   
    }   
    return out;   
}
</script>
</html>
<?php $this->endPage() ?>
