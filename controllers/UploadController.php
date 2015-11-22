<?php

namespace app\controllers;
use Qiniu\Auth;


class UploadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // return $this->render('index');
    }

    public function actionToken()
    {
		$accessKey = 'KfjTLZlT7JQAXt0U8dOPRC7QcHu0_Z4QwWdtTAVN';
		$secretKey = '78DH5Zr7mbHtYxCJUhlfKwKUobuqJ6euyVLXA6NB';
		$auth = new Auth($accessKey, $secretKey);

		$bucket = 'peterimg';
		$upToken = ['uptoken'=>$auth->uploadToken($bucket)];

		echo json_encode($upToken);

    }
}
