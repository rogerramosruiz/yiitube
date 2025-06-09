<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

Class HelloController extends Controller {

    public function actionIndex(){

        return $this->render('index');
    }

}

?>