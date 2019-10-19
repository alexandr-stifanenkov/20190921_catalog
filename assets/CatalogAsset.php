<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class CatalogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/catalog.css',
    ];
    public $js = [
        'js/catalog.js'
    ];
    public $depends = [
        'app\assets\SiteAsset',
    ];
}
