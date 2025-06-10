<?php 
/** @var $model \common\models\Video */
use \yii\helpers\StringHelper;
use \yii\helpers\Url;

?>
<div class="d-flex" >
    <a href="<?php echo Url::to(['/video/update', 'video_id' => $model->video_id])?>">
        <div>
            <div class="ratio ratio-16x9 " style="width: 120px;">
                <video src="<?= $model->getVideoLink() ?>" controls poster="<?= $model->getThumnailLink() ?>"></video>
            </div>
        </div>
    </a>
    <div>
        <h6><?= $model->title ?></h6>
         <?= StringHelper::truncateWords($model->description, 10) ?>
     </div>
</div>
