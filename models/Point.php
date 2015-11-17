<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "point".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $lat
 * @property integer $lon
 * @property integer $create_at
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
            [['create_at', 'user_id'], 'integer'],
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
        ];
    }
}
