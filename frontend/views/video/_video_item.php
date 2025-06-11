<?php

/** @var $model \common\models\Video */
use \yii\helpers\Url;
?>

<div class="card m-3" style="width: 14rem;">
    <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
     <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; margin-bottom: 1rem;">
        <video 
            src="<?= $model->getVideoLink() ?>" 
            poster="<?= $model->getThumnailLink() ?>" 
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
        </video>
    </div>
    </a>
    <div class="card-body p-2">
        <h6 class="card-title m-0"><?php echo $model->title ?></h6>
        <p class="text-muted card-text m-0">
            <?php echo \common\helpers\Html::ChannelLink($model->createdBy) ?>
        </p>
        
        <p class="text-muted card-text m-0">
            <?php echo $model->getViews()->count() ?> views ·
            <?php 
                echo Yii::$app->formatter->asRelativeTime($model->created_at) 
            ?>
        </p>
    </div>
</div>