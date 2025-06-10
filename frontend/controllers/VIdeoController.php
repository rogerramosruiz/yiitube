<?php

namespace frontend\controllers;
use \yii\web\Controller;
use common\models\Video;
use yii\data\ActiveDataProvider;

class VideoController extends Controller {
    public function actionIndex() { 

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published()->latest() ]);
            return $this->render("index", [
            'dataProvider' => $dataProvider,
        ]);
    }
}