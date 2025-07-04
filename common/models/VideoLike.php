<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "video_like".
 *
 * @property int $id
 * @property string $video_id
 * @property int $user_id
 * @property int|null $type
 * @property int|null $created_at
 *
 * @property User $user
 * @property Video $video
 */
class VideoLike extends \yii\db\ActiveRecord
{
    const TYPE_LIKE = 1;
    const TYPE_DISLIKE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'created_at'], 'default', 'value' => null],
            [['video_id', 'user_id'], 'required'],
            [['user_id', 'type', 'created_at'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Video::class, 'targetAttribute' => ['video_id' => 'video_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Video]].
     *
     * @return \yii\db\ActiveQuery|VideoQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::class, ['video_id' => 'video_id']);
    }

    /**
     * {@inheritdoc}
     * @return VideoLikeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoLikeQuery(get_called_class());
    }

}
