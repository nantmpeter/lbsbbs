<?php
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '附近的公告';
?>
<style type="text/css">
    .more {float: right;}
</style>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<?php if(!isset($_GET['lat'])) { ?>

<script type="text/javascript">
    $(function(){
        navigator.geolocation.getCurrentPosition(position);
        function position(p){
            var lat = p.coords.latitude.toString(),
                lon = p.coords.longitude.toString();
                localStorage.lat = lat.substr(0,10);
                localStorage.lon = lon.substr(0,10);
            location.href = "?lat="+lat.substr(0,10)+"&lon="+lon.substr(0,10);
        }
    });
</script>
<div class="am-dimmer am-active" data-am-dimmer="" id="am-dimmer-d2qaa" style="display: block;"></div>
<div class="am-modal am-modal-loading am-modal-no-btn am-modal-active" tabindex="-1" id="my-modal-loading" style="display: block; margin-top: -50.5px;"><div class="am-modal-dialog"><div class="am-modal-hd">定位中......</div><div class="am-modal-bd"><span class="am-icon-spinner am-icon-spin"></span></div></div></div>
<!-- 触发 button -->

<?php }else{?>
<script type="text/javascript">
    $(function(){
                $(".more").click(function(){
                    location.href = '/point?lat='+localStorage.lat+'&lon='+localStorage.lon;
                    return false;
                });
            });
</script>
<div class="post-index">

<div class="am-list-news-bd">
<div>
<?php 
    if($points) {
        foreach ($points as $key => $point) {
            echo '<a href="/point/view?id='.$point->id.'" class="am-badge ';
            if($point->auth) echo "am-badge-danger am-round"; else echo "am-badge-warning";
            echo ' am-text-default">'.$point->name.'</a> ';
        }
        echo '<a href="#" class="more am-icon-angle-double-right"></a>';
    }else{
        echo '<div class="am-alert am-alert-warning"><a href="/point/create">附近没有地点，新建一个试试？</a></div>';
    }
 ?>
</div>

    <ul class="am-list">
        <?php 
        $models = array_values($dataProvider->getModels());
        foreach ($models as $key => $value) {
            echo '<li class="am-g am-list-item-dated"><a class="am-list-item-hd" href="/post/view?id='.$value['id'].'">'.$value['title'].'</a><span class="am-list-date">';
            if($value['reply_at'] == $value['create_at'])
                echo '创建于 '.date('m-d H:i',$value['create_at']);
            else
                echo '最后回复于 '.date('m-d H:i',$value['reply_at']);
            echo '</span></li>';
        }
     ?>
    </ul>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
  </div>
</div>
<?php    } ?>
