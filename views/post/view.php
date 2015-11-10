<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
    <h1 class="am-article-title"><?= Html::encode($model->title) ?></h1>
    <p class="am-article-meta"><?php echo date('Y-m-d H:i:s',$model->create_at); ?></p>
  </div>

  <div class="am-article-bd">
    <!-- <p class="am-article-lead"></p> -->
    <?php echo $model->content; ?>
  </div>
</article>
<!--     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'create_at',
            'update_at',
            'user_id',
            'reply_at',
            'last_reply_id',
            'content',
            'lat', 
            'lon',
        ],
    ]) ?> -->

</div>
