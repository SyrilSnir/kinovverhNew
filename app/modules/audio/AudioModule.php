<?php

namespace app\modules\audio;

use yii\base\Module;

/**
 * Description of AudioModule
 *
 * @author kotov
 */
class AudioModule extends Module
{
    public $controllerNamespace = 'app\modules\audio\controllers';
    
    public function init()
    {
        parent::init();
        $this->setLayoutPath('@layouts');
    }    
}
