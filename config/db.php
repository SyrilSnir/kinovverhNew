<?php

use yii\db\Connection;

return [  
    'class' => Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=kv',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'tablePrefix' => 'sn_'
];
