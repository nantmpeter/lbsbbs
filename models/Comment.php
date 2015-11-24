<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property resource $content
 * @property integer $create_at
 * @property integer $user_id
 * @property integer $post_id
 * @property string $img
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'create_at', 'user_id', 'post_id'], 'required'],
            [['content'], 'string'],
            [['create_at', 'user_id', 'post_id'], 'integer'],
            [['img'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'create_at' => 'Create At',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'img' => 'Img',
        ];
    }
}
