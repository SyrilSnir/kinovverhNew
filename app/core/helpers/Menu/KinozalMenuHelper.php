<?php

namespace app\core\helpers\Menu;

use app\models\ActiveRecord\Film;

/**
 * Description of KinozalMenuHelper
 *
 * @author kotov
 */
class KinozalMenuHelper implements MenuHelperInterface
{
    
    public static function getMenu($params = []): array
    {
        /* @var $film Film */
        $slug = $params['slug'];
        $view = $params['view'];
        $film = $params['film'];
        $kinopanoramaEnable = $film->kinopanorama_active;
        if (empty($slug)) {
            return [];
        }
        $url = "/kinozal/{$slug}/";
        return [
            [
                'label' => 'Смотреть онлайн', 
                'url' => ["{$url}index"],
                'active' => ($view === 'index')
            ],
            self::_getKinopanoramaMenu($url, $view, $kinopanoramaEnable),
            [
                'label' => 'Комментарии', 
                'url' => ["{$url}comments"],
                'active' => ($view === 'comments')
            ]
    
        ];
    }
    
    private static function _getKinopanoramaMenu(
            string $baseUrl,
            string $view,
            bool $enable): array
    {
        $menuParams = [
            'label' => 'Кинопанорама', 
        ];
        if ($enable) {
            $menuParams['url'] = "{$baseUrl}panorama";            
        } else {
            $menuParams['url'] = '#';
            $menuParams['options'] = [
                'class' => ' film-tabs__hidden',
            ];             
        }
        $menuParams['active'] = ($view === 'panorama');
        return $menuParams;
        
              /*  
                 [
                
                'url' => '#',//["{$url}panorama"],
                'options' => [
                    'class' => ' film-tabs__hidden',
                ],
                'active' => ($view === 'panorama')
            ],*/
    }

}
