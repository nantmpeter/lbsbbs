<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
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
            echo '<li class="am-g am-list-item-dated"><a class="am-list-item-hd" href="/post/view?id='.$value['id'].'">';
            if($value['is_top'] == 1)
                echo '<strong class="am-badge am-badge-danger am-round">顶</strong> ';
            echo $value['title'].'</a><span class="am-list-date">';
            if($value['reply_at'] == $value['create_at'])
                echo '创建于 '.date('m-d H:i',$value['create_at']);
            else
                echo '最后回复于 '.date('m-d H:i',$value['reply_at']);
                                    // 创建者有权置顶
            if(\Yii::$app->user->id == $model->user_id){
                if($value['is_top'] == 0)
                    echo ' <span post-id="'.$value['id'].'" class="am-badge am-badge-danger set-top">设置为置顶</span>';
                else
                    echo ' <span post-id="'.$value['id'].'" class="am-badge am-badge-warning unset-top">取消置顶</span>';
            }
            echo '</span>';
            echo '</li>';
        }
     ?>
    </ul>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
  </div>
</div>

<script type="text/javascript">
    $(function(){
        $('.set-top').click(function(){
            var id = $(this).attr('post-id');
            $.get('/post/top',{'id':id},function(){
                location.reload();
            });
            return false;
        });
        $('.unset-top').click(function(){
            var id = $(this).attr('post-id');
            $.get('/post/untop',{'id':id},function(){
                location.reload();
            });
            return false;
        });
    })
</script>