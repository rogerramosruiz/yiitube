<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VideoLike]].
 *
 * @see VideoLike
 */
class VideoLikeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VideoLike[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VideoLike|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function userIdVideoId($userId, $videoId){
        return $this->andWhere([
            'video_id' => $videoId,
            'user_id' => $userId
        ]);
    }

    public function liked(){
        return $this->andWhere(['type'=>VideoLike::TYPE_LIKE]);
    }
    
    public function disliked(){
        return $this->andWhere(['type'=>VideoLike::TYPE_DISLIKE]);
    }
}
