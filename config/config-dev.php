<?php

use yii\debug\Module as DebugModule;
use yii\gii\Module as GiiModule;

return [
    'bootstrap' => ['log','gii','debug'],
    'modules' => [
        'gii' => [
            'class' => GiiModule::class,
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
        ],        
        'debug' => [
            'class' => DebugModule::class,
            // uncomment and adjust the following to add your IP if you are not connecting from localhost.
            // 'allowedIPs' => ['127.0.0.1', '::1'],
        ],
    ],
];
