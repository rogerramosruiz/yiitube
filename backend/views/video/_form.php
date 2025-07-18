<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\Video $model */
/** @var yii\widgets\ActiveForm $form */
\backend\assets\TagsInputAsset::register($this);
$this->registerJs("
    var input = document.querySelector('#post-tags'); // Adjust ID to match your field
    new Tagify(input);
");
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']]
    ); ?>
    <div class="row">
        <div class="col-sm-8">
            <?php echo $form->errorSummary($model) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'tags')->textInput(['id' => 'post-tags']) ?>
            
            <!-- <?= $form->field($model, 'tags')->textInput(['id' => 'post-tags']) ?> -->
            <div class="form-groups">
                <label for="">
                    <?php echo $model->getAttributeLabel('thumbnail') ?>
                </label>
                <div class="custom-file">
                    <input 
                    type="file" class="custom-file-input"
                    id="thumbnail" name="thumbnail">
                    <label class="custom-file-label" for="thumbnail">Choose file</label>
                </div>
            </div>

            <!-- <?= $form->field($model, 'has_thumbnail')->textInput() ?> -->

            <!-- <?= $form->field($model, 'video_name')->textInput(['maxlength' => true]) ?> -->
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <a href="<?php echo $model->getVideoLink()?>">
                    Open video
                </a>

                <div class="text-muted">
                    Video Link
                </div>
            <div class="ratio ratio-16x9 mb-3">
                <video src="<?php echo $model->getVideoLink()?>" controls
               poster="<?php echo $model->getThumnailLink()?>" 
                ></video>
            </div> 
        </div>
            <div class="mb-3">
                <div class="text-muted">
                    Video name
                </div>
                <?php echo $model->video_name ?>
            </div>
            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
