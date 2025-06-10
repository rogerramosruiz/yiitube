<?php

namespace backend\assets;

use yii\web\AssetBundle;

class TagsInputAsset extends AssetBundle
{
    public $css = [
        'https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css',
    ];

    public $js = [
        'https://cdn.jsdelivr.net/npm/@yaireo/tagify',
    ];

    public $depends = [
        'yii\web\YiiAsset', // Provides jQuery
        'yii\bootstrap5\BootstrapAsset', // Required for Bootstrap 5 (optional if you use Bootstrap styles)
    ];
}
