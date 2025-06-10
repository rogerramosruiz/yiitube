<?php

/** @var $model \common\models\Video */
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
                123 views · <?php echo Yii::$app->formatter->asDate($model->created_at)?>
            </div>
            <div>
                <button class="btn btn-small btn-outline-primary">
                    <i class="fa-solid fa-thumbs-up"></i> 9
                </button>
                <button class="btn btn-small btn-outline-secondary">
                    <i class="fa-solid fa-thumbs-down"></i> 3
                </button>

            </div>
        </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>