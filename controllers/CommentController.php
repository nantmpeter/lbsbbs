<?php

namespace app\controllers;
use app\models\Comment;

class CommentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
    	$data = $_POST['data'];
    	$data['create_at'] = time();
    	$data['user_id'] = 0;
    	$comment = new Comment();
    	$comment->attributes = $data;
    	// var_dump($data,$comment);exit;
    	$comment->save();
		$this->redirect(array('/post/view','id'=>$data['post_id']));
    }

}
