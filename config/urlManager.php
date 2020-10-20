<?php
use app\core\components\url\KinozalRule;

return [    
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        
       [
            'pattern' => '',
            'route' => 'kinozal',
            'suffix' => ''
        ],
        'adminka/<controller>/<action>' => 'adminka/<controller>/<action>',
        'adminka/<controller>/<action>/<id:[\d]+>' => 'adminka/<controller>/<action>',
       'adminka/widgets/<controller>/<action>' => 'adminka/widgets/<controller>/<action>',
        'about/<page:[\w\-]+>' => 'static-pages/index',    // статические страницы
        'lk' => 'cabinet/index', // личный кабинет пользователя
        'lk/<action:[\w\-]+>' => 'cabinet/<action>', // личный кабинет пользователя
        'kinozal/categories/<genreSlug:[\w\-]+>' => 'kinozal/categories/genre',
        'kinozal/categories' => 'kinozal/categories',
        '<media:(gallery|trailers)>/<action:(upload|delete)>/<modelId:\d+>' => '<media>/<action>',
        ['class' => KinozalRule::class],
        
    ],
];

