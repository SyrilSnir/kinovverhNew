<?php

use app\models\ActiveRecord\UserType;

return [
    [
        'id' => UserType::ROOT_USER_ID,
        'name' => 'Администратор',
        'slug' => 'admin'
    ],
    [
        'id' => UserType::DEFAULT_USER_ID,
        'name' => 'Пользователь',
        'slug' => 'user',
    ]
];

