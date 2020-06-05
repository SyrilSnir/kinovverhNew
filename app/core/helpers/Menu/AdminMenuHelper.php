<?php

namespace app\core\helpers\Menu;

/**
 * Description of AdminMenuHelper
 *
 * @author kotov
 */
class AdminMenuHelper implements MenuHelperInterface
{
    
    public static function getMenu($params = array()): array
    {
        return [
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => [
                [
                    'label' => 'Администрирование',
                    'icon' => 'cog',
                    'items' => [
                        ['label' => 'Пользователи', 'icon' => 'user-circle', 'url' => ['/adminka/user'],],
                    ]
                ],
                [
                    'label' => 'Кинозал',
                    'icon' => 'share',
                    'items' => [
                        ['label' => 'Фильмы', 'icon' => 'film', 'url' => ['/adminka/films'],],
                        ['label' => 'Жанры', 'icon' => 'film', 'url' => ['/adminka/genre'],],
                        ['label' => 'Комментарии', 'icon' => 'comments', 'url' => ['/adminka/comments'],],
                    ]
                ],
                [
                    'label' => 'Музыкальный раздел',
                    'icon' => 'share',
                    'items' => [
                        ['label' => 'Альбомы', 'icon' => 'music', 'url' => ['/adminka/albums'],],
                        ['label' => 'Треки', 'icon' => 'music', 'url' => ['/adminka/tracks'],],
                        ['label' => 'Жанры', 'icon' => 'music', 'url' => ['/adminka/music-genre'],],
                    ]
                ],
                [
                    'label' => 'Справочники',
                    'icon' => 'share',
                    'items' => [
                        ['label' => 'Страны', 'icon' => 'map', 'url' => ['/adminka/countries'],],
                        ['label' => 'Персоны', 'icon' => 'user', 'url' => ['/adminka/person'],],
                    ]
                ],
                [
                    'label' => 'Медиатека',
                    'icon' => 'share',
                    'items' => [
                        ['label' => 'Видео файлы', 'icon' => 'file-video-o', 'url' => ['/adminka/video'],],
                        ['label' => 'Аудио файлы', 'icon' => 'file-audio-o', 'url' => ['/adminka/audio'],],
                    ]
                ]
            ]
        ];
    }

}
