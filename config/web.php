<?php

use app\assets\YiiAsset;
use app\core\manage\auth\UserIdentity;
use app\modules\adminka\Module as Adminka;
use app\modules\api\ApiModule;
use app\modules\audio\AudioModule;
use app\modules\kinozal\KinozalModule;
use dosamigos\fileupload\FileUploadUIAsset;
use kartik\file\PiExifAsset;
use kartik\select2\Select2Asset;
use mihaildev\elfinder\Controller as ElfController;
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
        'controllerMap' => [
                'elfinder' => [
                    'class' => ElfController::class,
                    'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
                    'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
                    'roots' => [
                        [
                            'baseUrl'=>'@web',
                            'basePath'=>'@webroot',
                            'path' => 'files/global',
                            'name' => 'Global'
                        ],
                        [
                            'class' => 'mihaildev\elfinder\volume\UserPath',
                            'path'  => 'files/user_{id}',
                            'name'  => 'My Documents'
                        ],
                        [
                            'path' => 'files/some',
                            'name' => ['category' => 'my','message' => 'Some Name'] //перевод Yii::t($category, $message)
                        ],
                        [
                            'path'   => 'files/some',
                            'name'   => ['category' => 'my','message' => 'Some Name'], // Yii::t($category, $message)
                            'access' => ['read' => '*', 'write' => 'UserFilesAccess'] // * - для всех, иначе проверка доступа в даааном примере все могут видет а редактировать могут пользователи только с правами UserFilesAccess
                        ]
                    ],
                    'watermark' => [
                                'source'         => __DIR__.'/logo.png', // Path to Water mark image
                             'marginRight'    => 5,          // Margin right pixel
                             'marginBottom'   => 5,          // Margin bottom pixel
                             'quality'        => 95,         // JPEG image save quality
                             'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                             'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                             'targetMinPixel' => 200         // Target image minimum pixel size
                    ]
                ]
            ],        
        'components' => [
            'assetManager' => [
                'appendTimestamp' => true,
                'bundles' => [
                    JqueryAsset::class => [
                        'js'=>[]
                    ],
                    Select2Asset::class => [
                        'depends' => [
                            YiiAsset::class
                        ]                    
                    ],                    
                    BootstrapPluginAsset::class => [
                        'js'=>[]
                    ],
                    FileUploadUIAsset::class => [
                        'depends' => [
                            YiiAsset::class,
                            'dosamigos\fileupload\BlueimpLoadImageAsset',
                            'dosamigos\fileupload\BlueimpCanvasToBlobAsset',
                            'dosamigos\fileupload\BlueimpTmplAsset'                            
                        ]
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
            'robokassa' => [
                'class' => '\robokassa\Merchant',
                'baseUrl' => 'https://auth.robokassa.ru/Merchant/Index.aspx',
                'sMerchantLogin' => 'vverhtest',
                'sMerchantPass1' => 'B1bzWrJ29Z98ogFZiGGI',
                'sMerchantPass2' => 'pJLMuMxSY82m96PYT4sv',
                'isTest' => true,
            ]            
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
            ],
            'api' => [
                'class' => ApiModule::class,
                'layout' => false,
                'defaultRoute' => 'main/index',                
            ],            
        ], 
        'params' => $params,
    ];

