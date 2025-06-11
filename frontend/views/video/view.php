<?php

use yii\helpers\Url;

/**
 *  @var $model \common\models\Video
 *  @var yii\web\View $this
 */
?>

<div class="row">
    <div class="col-sm-8">
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
                <?php echo $model->createdBy->username?>
                <?php echo \yii\helpers\Html::encode($model->description)?>
           </p> 
        </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>