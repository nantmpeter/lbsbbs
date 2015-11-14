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
<style type="text/css">
    .am-comment {
        margin-top: 20px;
    }
</style>
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
    <h1 class="am-article-title"><?= Html::encode($model->title) ?></h1>
    <p class="am-article-meta"><?php echo date('Y-m-d H:i:s',$model->create_at); ?></p>
  </div>

  <div class="am-article-bd">
    <!-- <p class="am-article-lead"></p> -->
    <?php echo $model->content; ?>
  </div>
</article>
<?php $comments = $data->getModels(); ?>
<article class="am-comment"> <!-- 评论容器 -->
 <!--  <a href="">
    <img class="am-comment-avatar" alt=""/> 
  </a>
 -->
 <?php foreach ($comments as $key => $value) { ?>
       <div class="comment-box"> <!-- 评论内容容器 -->
    <header class="am-comment-hd">
      <!--<h3 class="am-comment-title">评论标题</h3>-->
      <div class="am-comment-meta"> <!-- 评论元数据 -->
        <!-- <a href="#link-to-user" class="am-comment-author">..</a> -->
        评论于 <time datetime=""><?php echo date('m-d H:i',$value->create_at) ?></time>
      </div>
    </header>

    <div class="am-comment-bd"><?php echo $value->content ?></div> <!-- 评论内容 -->
  </div>
 <?php } ?>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
 
<form class="am-form" action='/comment/create' method="post">
  <!-- <fieldset disabled> -->
    <div class="am-form-group">
    <input type="hidden" name="data[post_id]" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
       <textarea class="" rows="5" name="data[content]"></textarea>
    </div>
    <button type="submit" class="am-btn am-btn-primary">评论</button>
  <!-- </fieldset> -->
</form>
</article>
</div>
