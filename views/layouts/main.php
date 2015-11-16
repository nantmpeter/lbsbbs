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
    #btn-location {
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
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="am-page" id="mobile-index">
<header class="main-header"><?= Html::a('发帖', ['/post/create'], ['class' => 'btn btn-success main-post']) ?><?php if($this->title != '') { ?><span class="am-icon-chevron-left" id="btn-back"></span><?php }else{ ?><span class="am-icon-home am-icon-sm" id="btn-home"></span><?php } ?> <span class='am-icon-location-arrow' id='btn-location'></span><h1><?= Html::encode($this->title) ?></h1></header>
<!-- <form action='/user/logout' method="post">
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
    <button type="submit">logout</button>
</form> -->
<script type="text/javascript" src="/js/jquery.min.js"></script>
        <div id="main-box">
            <?= $content ?>        
        </div>
</div>


<?php $this->endBody() ?>
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
    });
</script>
</html>
<?php $this->endPage() ?>
