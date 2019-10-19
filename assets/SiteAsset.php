<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Site asset bundle.
 */
class SiteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/vue.js',
        'js/axios.min.js',
    ];
    public $depends = [];
}
