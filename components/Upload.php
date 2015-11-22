<?php

namespace app\components;

// 引入鉴权类
use Qiniu\Auth;

// 引入上传类
use Qiniu\Storage\UploadManager;

/**
* 上传文件或图片
*/
class Upload
{
    $accessKey = 'KfjTLZlT7JQAXt0U8dOPRC7QcHu0_Z4QwWdtTAVN';
    $secretKey = '78DH5Zr7mbHtYxCJUhlfKwKUobuqJ6euyVLXA6NB';

	public static function Img()
	{
    	$auth = new Auth($this->accessKey, $this->secretKey);
	    $bucket = 'peterimg';

	    // 生成上传 Token
	    $token = $auth->uploadToken($bucket);
	    
	    // 要上传文件的本地路径
	    $filePath = './php-logo.png';

	    // 上传到七牛后保存的文件名
	    $key = 'my-php-logo.png';

	    // 初始化 UploadManager 对象并进行文件的上传。
	    $uploadMgr = new UploadManager();
	    list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
	    echo "\n====> putFile result: \n";
	    if ($err !== null) {
	        var_dump($err);
	    } else {
	        var_dump($ret);
	    }
	}
}