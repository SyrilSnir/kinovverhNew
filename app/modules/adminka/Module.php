<?php

namespace app\modules\adminka;

use app\modules\adminka\modules\widgets\Module as WidgetModule;
use yii\base\Module as BaseModule;

/**
 * Модуль админки
 *
 * @author kotov
 */
class Module extends BaseModule
{
    public $controllerNamespace = 'app\modules\adminka\controllers';
    
    public function init()
    {
        parent::init();
        $this->modules = [
            'widgets' => [
                'class' => WidgetModule::class,
            ],            
        ];
    }
}

