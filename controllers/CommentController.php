<?php

namespace app\controllers;
use app\models\Comment;
use app\models\Post;

class CommentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
    	$data = $_POST['data'];
    	$time = time();
    	$data['create_at'] = $time;
    	$data['user_id'] = 0;
    	$comment = new Comment();
    	$comment->attributes = $data;
    	$post = new Post();
    	$post->updateAll(['reply_at'=>$time],'id=:id',[':id'=>$data['post_id']]);

    	$comment->save();
		$this->redirect(array('/post/view','id'=>$data['post_id']));
    }

}
