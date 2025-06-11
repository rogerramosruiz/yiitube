<?php

namespace frontend\controllers;
use common\models\VideoLike;
use common\models\VideoView;
use Symfony\Component\EventDispatcher\DependencyInjection\AddEventAliasesPass;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use \yii\web\Controller;
use common\models\Video;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use function PHPUnit\Framework\returnArgument;

class VideoController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike'],
                'rules' => [
                    [
                        'allow' => true, 
                        'roles' => ['@']
                    ]
                ]
            ],
            'verb' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]

        ];
        
    }
    public function actionIndex() { 

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published()->latest() ]);
            return $this->render("index", [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id){
        $this->layout = 'auth';
        $video = $this->findVideo($id);
        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView-> user_id = \Yii::$app->user->id; 
        $videoView->created_at = time();
        $videoView->save();
        return $this->render('view', [
            'model' => $video
        ]);

    }

    public function actionLike($id){
        $video = $this->findVideo($id);
        $userId = \Yii::$app->user->id;
        $videoLikeDislike = VideoLike::find()->andWhere([
            'video_id' => $id,
            'user_id' => $userId
        ])->one();

        if (!$videoLikeDislike){
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
        }
        else if($videoLikeDislike->type == VideoLike::TYPE_LIKE){
            $videoLikeDislike->delete();
        }
        else{
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
        }
        return $this->renderAjax('_buttons', [
            'model' => $video
        ]);
    }

    public function actionDislike($id){
        $video = $this->findVideo($id);
        $userId = \Yii::$app->user->id;
        $videoLikeDislike = VideoLike::find()->andWhere([
            'video_id' => $id,
            'user_id' => $userId
        ])->one();

        if (!$videoLikeDislike){
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
        }
        else if($videoLikeDislike->type == VideoLike::TYPE_DISLIKE){
            $videoLikeDislike->delete();
        }
        else{
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
        }
        return $this->renderAjax('_buttons', [
            'model' => $video
        ]);
    }
    
    protected function saveLikeDislike($videoId, $userId, $type){
        $videoLikeDislike = new VideoLike();
        $videoLikeDislike->video_id = $videoId;
        $videoLikeDislike->user_id= $userId;
        $videoLikeDislike->created_at = time();
        $videoLikeDislike->type = $type;
        $videoLikeDislike->save();
    }
    protected function findVideo($id){
        $video = Video::findOne($id);
        if(!$video){
            throw new NotFoundHttpException('Video does not exist');
        }
        return $video;
    }
}