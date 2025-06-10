<?php

/** @var $model \common\models\Video */
?>

<div class="card m-3" style="width: 14rem;">
     <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; margin-bottom: 1rem;">
        <video 
            src="<?= $model->getVideoLink() ?>" 
            poster="<?= $model->getThumnailLink() ?>" 
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
        </video>
    </div>

    <div class="card-body p-2">
        <h6 class="card-title m-0"><?php echo $model->title ?></h6>
        <p class="text-muted card-text m-0">
            <?php echo $model->createdBy->username ?>
        </p>
        
        <p class="text-muted card-text m-0">
            140 views.
            <?php 
                echo Yii::$app->formatter->asRelativeTime($model->created_at) 
            ?>
        </p>
    </div>
</div>