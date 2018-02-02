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
        'datatables/dataTables.bootstrap.css',
        'css/site.css',
    ];
    public $js = [
        'datatables/dataTables.bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'raoul2000\bootswatch\BootswatchAsset',
        'dmstr\web\AdminLteAsset',
    ];
}
