<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "point".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property string $lat
 * @property string $lon
 * @property integer $create_at
 * @property integer $post_num 
 * @property integer $auth 
 * @property integer $user_id
 */
class Point extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_at', 'user_id','post_num','auth'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 256],
            [['lat', 'lon'], 'string', 'max' => 11]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'lat' => 'Lat',
            'lon' => 'Lon',
            'create_at' => 'Create At',
            'user_id' => 'User ID',
            'post_num' => 'Post Num', 
            'auth' => 'Auth', 
        ];
    }

    public static function getPoints($num,$lat,$lon)
    {
        $sql = 'SELECT * from (SELECT id,name,lon,lat,create_at, post_num,auth, ROUND(6378.138*2*ASIN(SQRT(POW(SIN((:lat*PI()/180-lat*PI()/180)/2),2)+COS(:lat*PI()/180)*COS(lat*PI()/180)*POW(SIN((:lon*PI()/180-lon*PI()/180)/2),2)))*1000) AS d FROM point ORDER BY d) a where d<300 order by auth desc,post_num desc,create_at desc limit :num';
        return self::findBySql($sql,[':lat'=>$lat,':lon'=>$lon,':num'=>$num])->all();
    }
}
