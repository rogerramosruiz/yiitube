<?php

namespace frontend\controllers;
use common\models\VideoLike;
use common\models\VideoView;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use \yii\web\Controller;
use common\models\Video;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class VideoController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike', 'history'],
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

        $this->layout = 'main';
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()
            ->with('createdBy')
            -> published()->latest(),
            'pagination' => [
                'pageSize' => 3
            ]]);
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

        $similarVideos = Video::find()
        ->published()
        ->andWhere(['NOT', ['video_id' => $id]])
        ->byKeyword($video->title)
        ->limit(10)->all();

        return $this->render('view', [
            'model' => $video,
            'similarVideos' => $similarVideos
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

    public function actionHistory(){
        $this->layout = 'main';
        $query = Video::find()->
        alias('v')
        ->innerJoin("(select video_id, max(created_at) as max_date
                from video_view
                where user_id = :userId
                group by video_id) vv", 'vv.video_id = v.video_id', [
                    'userId' => \Yii::$app->user->id
                ]
                )->orderBy('vv.max_date DESC');
            $dataProvider = new ActiveDataProvider([
            'query' => $query
         ]);
            
        return $this->render("history", [
        'dataProvider' => $dataProvider,
        ]);
    }
    protected function findVideo($id){
        $video = Video::findOne($id);
        if(!$video){
            throw new NotFoundHttpException('Video does not exist');
        }
        return $video;
    }

    public function actionSearch($keyword){
        $this->layout = 'main';
        $query = Video::find()
            ->wit('createdBy')
            ->published()
            ->latest();
        if ($keyword){
            $query->byKeyword($keyword);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
         ]);
            
        return $this->render("search", [
        'dataProvider' => $dataProvider,
        ]);
    }
}