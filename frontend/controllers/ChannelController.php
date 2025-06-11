<?php
namespace frontend\controllers;
use common\models\User;
use yii\web\Controller;
use common\models\Video;
use common\models\Subscriber;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use Imagine\Exception\NotFoundException;


class ChannelController extends Controller{
    public function behaviors() {
        return [
            'access' => [ 
                'class' => AccessControl::class,
                'only' => ['subscribe'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    public function actionView($username) {
        $channel = $this->findChannel($username);
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->creator($channel->id)->published()
        ]);
        return $this->render('view', [
            'channel' => $channel,
            'dataProvider' => $dataProvider
        ]);
        
    }
    public function actionSubscribe($username){
        $userId = \Yii::$app->user->id;
        $channel = $this->findChannel($username);
        $subscriber = $channel->isSubscribed($userId);
        if(!$subscriber){
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id= $userId;
            $subscriber->created_at = time();
            $subscriber->save();
        }
        else{
            $subscriber->delete();
        }
        return $this->renderAjax('_subscribe', [
            'channel' => $channel
        ]);

    }
    protected function findChannel($username){

        $channel = User::findByUsername($username);
        if (!$channel){
            throw new NotFoundException("Channel does not exists");
        }
        return $channel;
    }
}