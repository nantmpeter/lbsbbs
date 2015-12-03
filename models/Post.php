<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $user_id
 * @property integer $reply_at
 * @property integer $last_reply_id
 * @property resource $content
 * @property string $lat
 * @property string $lon
 * @property integer $point_id
 */
class Post extends \yii\db\ActiveRecord
{
    // 距离
    public $d;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_at', 'update_at', 'user_id', 'reply_at', 'last_reply_id', 'point_id', 'is_top'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['lat', 'lon'], 'string', 'max' => 11],
            [['img'], 'string', 'max' => 256]
        ];
    }

    public function geoList()
    {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
        $sql = 'SELECT id,lon,lat, ROUND(6378.138*2*ASIN(SQRT(POW(SIN(('.$lat.'*PI()/180-lat*PI()/180)/2),2)+COS('.$lat.'*PI()/180)*COS(lat*PI()/180)*POW(SIN(('.$lon.'*PI()/180-lon*PI()/180)/2),2)))*1000) AS d FROM post ORDER BY d DESC';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'user_id' => 'User ID',
            'reply_at' => 'Reply At',
            'last_reply_id' => 'Last Reply ID',
            'content' => '内容',
            'lat' => 'Lat',
            'lon' => 'Lon',
            'point_id' => 'Point ID', 
            'img' => 'Img',
            'is_top' => 'Is Top',
        ];
    }

    public function beforeSave($insert)
    {
        $post = \Yii::$app->request->post();
        if (parent::beforeSave($insert)) {
            if($insert) {
                if(isset($post['Post'])) {
                    // 30 分钟内禁止同一个人发布标题相同的帖子
                    $r = Post::find()->where(['user_id'=>User::getCurrentId(),'title'=>$post['Post']['title']])->andWhere('create_at > :time',[':time'=>time()-60*30])->all();
                    if(count($r) > 0)
                        return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
