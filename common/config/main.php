<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'pay'],
                "<controller>/<action>/<id:\w+>" => '<controller>/<action>',
                "<controller>/<action>/<id:\w+>/<cat:\w+>" => '<controller>/<action>',
                "<controller>/<action>/<id:\w+>/<lang:\w+>" => '<controller>/<action>',
                "<controller>/<action>/<id:\w+>/<id2:\w+>" => '<controller>/<action>'
            ]
        ],
    ],
];
