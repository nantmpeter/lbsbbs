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
    #btn-back {
        position: absolute;
        margin-top: 6px;
    }
    .main-post {
        float: right;
    }
    #main-box {
        padding: 10px;
    }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="am-page" id="mobile-index">
<header class="main-header"><?= Html::a('发帖', ['create'], ['class' => 'btn btn-success main-post']) ?><span class="am-icon-chevron-left" id="btn-back"></span><h1><?= Html::encode($this->title) ?></h1></header>
    <!-- <div class="container"> -->
       <!-- <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>-->
        <div id="main-box">
            <?= $content ?>        
        </div>
    <!-- </div> -->
</div>
<!-- </div> -->
<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
<script type="text/javascript">
    $(function(){
        $("#btn-back").click(function(){
            history.go(-1);
        });
    });
</script>
</html>
<?php $this->endPage() ?>
