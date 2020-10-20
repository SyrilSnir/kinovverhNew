<?php

namespace app\widgets;

use app\core\repositories\Widgets\WidgetRepository;
use app\models\ActiveRecord\Widget\WidgetsList;
use yii\base\Widget;

/**
 * Description of KinovverhWidget
 *
 * @author kotov
 */
abstract class KinovverhWidget extends Widget
{
    /**
     *
     * @var bool Виджет вкл/выкл
     */
    protected $enable = false;
    
    protected $rootTemplate = '';
    
    protected $templateVariables = [];


    public function init()
    {
        /** @var WidgetsList $widget */
        parent::init();
        $widget = WidgetRepository::findByClassName(static::class);
        if (!$widget) {
            return;
        }
        $this->enable = (bool) $widget->activate;
    }
    
    public function run(): string
    {
        if ($this->enable) {
            return $this->render($this->rootTemplate, $this->templateVariables);
        }
        return '';
    }
}
