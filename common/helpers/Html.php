<?php 


namespace common\helpers;
use yii\helpers\Url;


class Html{

    public static function ChannelLink($user, $schema = false)  {
        return  \yii\helpers\Html::a($user->username, 
        Url::to(['/channel/view','username' => $user->username], $schema), [
            'class' => 'text-dark'
        ]);
        
    }
}