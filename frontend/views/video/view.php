<?php

use yii\helpers\Url;
use \yii\helpers\Html;

/**
 *  @var $model \common\models\Video
 *  @var $similarVideo \common\models\Video[]
 *  @var yii\web\View $this
 */
?>

<div class="row">
    <div class="col">
        <div class="embed-responsive embed-responsive-16by9">
            <video 
                class="embed-responsive-item"
                src="<?= $model->getVideoLink() ?>" 
                poster="<?= $model->getThumnailLink() ?>" 
                controls></video>
        </div>

        <h6 class="mt-2"><?php echo $model->title ?></h6>
        <div class="d-flex justify-content-between align-items-center">
            <div>
            <?php echo $model->getViews()->count() ?> views · <?php echo Yii::$app->formatter->asDate($model->created_at)?>
            </div>
            <div>
                <?php \yii\widgets\Pjax::begin() ?>
                <?php 
                    echo $this->render('_buttons', [
                        'model' => $model
                    ]) 
                ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
        <div>
           <p>
                <?php echo \common\helpers\Html::ChannelLink($model->createdBy) ?>
           </p> 

                <?php echo Html::encode($model->description)?>
        </div>
    </div>
    <div class="col">
        <?php foreach($similarVideos as $similarVideo):?>
        <div class="media mb-3">
            <a href="<?php echo Url::to(['video/view', 'id' => $similarVideo->video_id])?>">
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; margin-bottom: 1rem;">
                    <video 
                        src="<?= $similarVideo->getVideoLink() ?>" 
                        poster="<?= $similarVideo->getThumnailLink() ?>" 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                    </video>
                </div>
            </a>
            <div class="media-body">
                <h5 class="mt-0"><?php echo $similarVideo->title?></h5>
                <div class="text-muted">
                    <p class="m-0">
                        <?php echo \common\helpers\Html::ChannelLink($similarVideo->createdBy) ?>
                    </p>
                    <small>
                        <?php echo $similarVideo->getViews()->count() ?> views · 
                        <?php echo Yii::$app->formatter->asRelativeTime($similarVideo->created_at)?>
                    </>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>