<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = ;
?>
<script type="text/javascript" src="/js/jquery.min.js"></script>

<!-- <div class="am-dimmer am-active" data-am-dimmer="" id="am-dimmer-d2qaa" style="display: block;"></div> -->
<!-- <div class="am-modal am-modal-loading am-modal-no-btn am-modal-active" tabindex="-1" id="my-modal-loading" style="display: block; margin-top: -50.5px;"><div class="am-modal-dialog"><div class="am-modal-hd">定位中......</div><div class="am-modal-bd"><span class="am-icon-spinner am-icon-spin"></span></div></div></div> -->
<!-- 触发 button -->


<div class="post-index">

<div class="am-list-news-bd">
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

