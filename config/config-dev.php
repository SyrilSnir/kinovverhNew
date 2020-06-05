<?php

use yii\debug\Module;

return [
    'bootstrap' => ['log','debug'],
    'modules' => [
        'debug' => [
        'class' => Module::class,
        // uncomment and adjust the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1'],
        ],
    ],
];
