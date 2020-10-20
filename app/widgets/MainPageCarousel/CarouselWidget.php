<?php

namespace app\widgets\MainPageCarousel;

use app\widgets\KinovverhWidget;

/**
 * Description of CarouselWidget
 *
 * @author kotov
 */
class CarouselWidget extends KinovverhWidget
{
    public function init()
    {
        parent::init();        
        $this->rootTemplate = 'carousel';
        $this->templateVariables['carouselItems'] = \app\models\ActiveRecord\Widget\CarouselWidgetElement::find()->all();
    }
}
