<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/dataTables.bootstrap.css',
        'css/site.css',
    ];
    public $js = [
        'js/jquery.dataTables.js',
        'js/dataTables.bootstrap.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'dmstr\web\AdminLteAsset',
    ];
}
