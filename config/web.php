<?php

use app\assets\YiiAsset;
use app\core\manage\auth\UserIdentity;
use app\modules\adminka\Module as Adminka;
use app\modules\audio\AudioModule;
use app\modules\kinozal\KinozalModule;
use kartik\file\PiExifAsset;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\caching\FileCache;
use yii\grid\GridViewAsset;
use yii\log\FileTarget;
use yii\rbac\PhpManager;
use yii\validators\ValidationAsset;
use yii\web\JqueryAsset;
use yii\widgets\ActiveFormAsset;

$params = require_once __DIR__ . '/params.php';
    return [
        'id' => 'kinovverh',
        'name' => 'Кинозал компании "ВВЕРХ"',
        'basePath' => dirname(__DIR__),
        'viewPath' => '@views',
        'language' => 'ru',
        'aliases' => [
            '@bower' => '@vendor/bower-asset',
            '@npm'   => '@vendor/npm-asset',
        ],        
        'components' => [
            'assetManager' => [
                'appendTimestamp' => true,
                'bundles' => [
                    JqueryAsset::class => [
                        'js'=>[]
                    ],
                    BootstrapPluginAsset::class => [
                        'js'=>[]
                    ],
                    BootstrapAsset::class => [
                        'css' => [],
                    ],
                    GridViewAsset::class => [
                        'depends' => [
                            YiiAsset::class
                        ]
                    ],
                    ActiveFormAsset::class => [
                        'depends' => [
                            YiiAsset::class
                        ]
                    ],
                    PiExifAsset::class => [
                        'depends' => [
                            YiiAsset::class
                        ]
                    ],
                    ValidationAsset::class => [
                        'depends' => [
                            YiiAsset::class
                        ]
                    ]
                ],
            ],
            'log' => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => FileTarget::class,
                        'levels' => ['error', 'warning','info'],
                        'logVars' => ['_GET', '_POST'],
                    ],
                ],            
            ],            
            'authManager' => [
                'class' => PhpManager::class,
            ],  
            'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => 'HUI34H5UI4HUI2H5UH34UIHUI5H3UI5HUI3HHU3UIHTTUIHTHUI3HTUI3HURG',
            ],
            'user' => [
                'identityClass' => UserIdentity::class,
                    'enableAutoLogin' => true,
                    'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
                    'loginUrl' => ['adminka/login'],
            ],
            'cache' => [
                'class' => FileCache::class,
                'defaultDuration' => 86400
            ],            
        ],
        'modules' => [   
            'kinozal' => [
                'class' => KinozalModule::class,
                'layout' => 'main',
                'defaultRoute' => 'main/index',
            ],
            'audio' => [
                'class' => AudioModule::class,
                'layout' => 'main',
                'defaultRoute' => 'main/index',
            ],
            'adminka' => [
                'class' => Adminka::class,
                'layout' => 'main',
                'defaultRoute' => 'main/index',                
            ]            
        ], 
        'params' => $params,
    ];

