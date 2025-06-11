<?php

use yii\helpers\Url;
/** @var $this \yii\web\View */
/** @var $channel \common\models\User */
/** @var $dataProvider \yii\data\ActiveDataProvider */

?>


<div class="jumbotron">
  <h1 class="display-4">
    <?php echo $channel->username?>
  </h1>
  <?php \yii\widgets\Pjax::begin()?>
    <hr class="my-4">
    <?php
        echo $this->render('_subscribe', [
            'channel' => $channel
        ]) 
    ?>
  <?php \yii\widgets\Pjax::end()?>

    <?php 
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' =>'@frontend/views/video/_video_item',
        'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false // remove div datakey for each item
        ]
    ])
    ?>
</div>