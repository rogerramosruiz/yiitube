<?php

/** @var yii\web\View $this */
/** @var $latestVideo \common\models\Video */
/** @var $numberOfView integer */
/** @var $numberOfSubscribers integer */
/** @var $subscribers \common\models\Subscriber[]*/

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="card" style="width: 18rem;">

    <div class="ratio ratio-16x9 mb-3">
            <video src="<?php echo $latestVideo->getVideoLink()?>" controls
            poster="<?php echo $latestVideo->getThumnailLink()?>" 
            ></video>
    </div> 
    <div class="card-body">
        <h5 class="card-title"><?php echo $latestVideo->title ?></h5>
        <p class="card-text">
            Likes: <?php echo $latestVideo->getLikes()->count()?> <br>
            Viewes: <?php echo $latestVideo->getViews()->count()?>
        </p>
        <a href="<?php echo \yii\helpers\Url::to(['/video/update', 'video_id' => $latestVideo->video_id]) ?>" class="btn btn-primary">
            Edit
        </a>
    </div>
    </div>
</div>
