<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '附近的公告';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <ul class="am-list am-list-static am-list-border">
    <?php 
    $models = array_values($dataProvider->getModels());
    foreach ($models as $key => $value) {
        echo '<li><a href="?r=post/view&id='.$value->id.'">'.$value->title.'</a></li>';
    }
     ?>
     </ul>
   <!--  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'create_at',
            'update_at',
            'user_id',
            // 'lat',
            // 'lon',
            // 'reply_at',
            // 'last_reply_id',
            // 'content',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> -->

</div>
