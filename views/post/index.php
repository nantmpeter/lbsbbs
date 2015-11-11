<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '附近的公告';
?>

<?php if(!isset($_GET['lat'])) { ?>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        navigator.geolocation.getCurrentPosition(position);
        function position(p){
            var lat = p.coords.latitude.toString(),
                lon = p.coords.longitude.toString();
            location.href = "?lat="+lat.substr(0,10)+"&lon="+lon.substr(0,10);
        }
    });
</script>
<div class="am-dimmer am-active" data-am-dimmer="" id="am-dimmer-d2qaa" style="display: block;"></div>
<div class="am-modal am-modal-loading am-modal-no-btn am-modal-active" tabindex="-1" id="my-modal-loading" style="display: block; margin-top: -50.5px;"><div class="am-modal-dialog"><div class="am-modal-hd">定位中......</div><div class="am-modal-bd"><span class="am-icon-spinner am-icon-spin"></span></div></div></div>
<!-- 触发 button -->

<?php }else{?>
<div class="post-index">

<div class="am-list-news-bd">
    <ul class="am-list">
        <?php 
        $models = array_values($dataProvider->getModels());
        foreach ($models as $key => $value) {
            echo '<li class="am-g am-list-item-dated"><a class="am-list-item-hd" href="/post/view?id='.$value->id.'">'.$value->title.'</a><span class="am-list-date">距离'.$value->d.'米</span></li>';
        }
     ?>
    </ul>
  </div>
</div>


<?php    } ?>
