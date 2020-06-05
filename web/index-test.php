<?php 
    // comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/functions.php';
require __DIR__ . '/../config/bootstrap.php';


$baseConfig = require __DIR__  . '/../config/web.php';
$componentsConfig['components']['urlManager'] = require __DIR__  . '/../config/urlManager.php';

$config = array_merge_recursive($baseConfig,$componentsConfig);

dump($config);
