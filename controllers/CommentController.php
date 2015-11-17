<?php

namespace app\controllers;
use app\models\Comment;
use app\models\Post;
use app\models\User;

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
    	$data['user_id'] = User::getCurrentId();
    	$comment = new Comment();
    	$comment->attributes = $data;
    	$post = new Post();
    	$post->updateAll(['reply_at'=>$time,'last_reply_id'=>$data['user_id']],'id=:id',[':id'=>$data['post_id']]);
    	$comment->save();
		$this->redirect(array('/post/view','id'=>$data['post_id']));
    }

}
