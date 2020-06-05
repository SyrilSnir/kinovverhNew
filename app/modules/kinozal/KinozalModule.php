<?php

namespace app\modules\kinozal;

use yii\base\Module;

/**
 * Description of KinozalModule
 *
 * @author kotov
 */
class KinozalModule extends Module
{    
    public $controllerNamespace = 'app\modules\kinozal\controllers';
    
    public function init()
    {
        parent::init();
        $this->setLayoutPath('@layouts');
    }
}
