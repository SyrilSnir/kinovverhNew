<?php

namespace app\core\helpers\Menu;

/**
 * Description of NavMenuHelper
 *
 * @author kotov
 */
class NavMenuHelper implements MenuHelperInterface
{
    
    public static function getMenu($params = []): array
    {
        return [
                    ['label' => 'Главная' , 'url' => ['/']],
                    ['label' => 'О кинозале' , 'url' => ['/about/o_kinozale']],
                    [
                    'label' => 'Фильмы',
                        'items' => [
                            ['label' => '6+', 'url' => ['/kinozal/categories/6plus'],],
                            ['label' => 'Детское кино', 'url' => ['/kinozal/categories/child'],],
                        ],
                    ],
                    ['label' => 'Музыка' , 'url' => ['/audio']],            
                    ['label' => 'Условия' , 'url' => ['/about/conditions']],
                ];        
    }

}
