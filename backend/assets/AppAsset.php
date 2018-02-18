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
        'css/custom.css',
    ];
    public $js = [
        'js/jquery.dataTables.js',
        'js/dataTables.bootstrap.js',
        'js/enroll.js',
        'js/main.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'dmstr\web\AdminLteAsset',
    ];
}
