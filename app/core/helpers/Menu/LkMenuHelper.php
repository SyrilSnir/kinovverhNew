<?php

namespace app\core\helpers\Menu;

/**
 * Description of LkMenuHelper
 *
 * @author kotov
 */
class LkMenuHelper implements MenuHelperInterface
{
    
    public static function getMenu($params = []): array
    { 
        return [
            ['label' => 'Главная', 'url' => '#home'],
            ['label' => 'Избранное', 'url' => '#favorites'],
            ['label' => 'Мои покупки', 'url' => '#buy'],
            ['template' => self::getRightNavbarTemplate()]
        ];
    }
    
    public static function getRightNavbarTemplate()
    {
        $htmlTemplate = <<<'HTML'
<li role="presentation" class=" navbar-right">
    <span class="lk-schet">
        <a href="#" class="lk-schet__button"><i class="fa fa-database" aria-hidden="true"></i> Счет: <b>0</b> р.</a>
        <a href="#pop-pay-add" class="btn lk-schet__add" data-toggle="modal">Пополнить счет</a>
    </span>
</li>                
HTML;
        return $htmlTemplate;
    }

}
