<?php

namespace app\core\helpers\View;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Description of ActivateHelper
 *
 * @author kotov
 */
class ActivateHelper
{
    const ENABLE = 1; //'Включен'
    
    const DISABLE = 0; //'Отключен'
    
    public static function statusList() :array
    {
        return [
            self::DISABLE => 'Отключен',
            self::ENABLE => 'Включен'
        ];
    }
    
    public static function statusName($status):string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }
    
    public static function statusLabel($status): string
    {
        switch ($status) {
            case self::DISABLE:
                $class = 'label label-default';
                break;
            case self::ENABLE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}
