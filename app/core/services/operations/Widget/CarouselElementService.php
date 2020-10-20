<?php

namespace app\core\services\operations\Widget;

use app\core\repositories\Widgets\CarouselElementRepository;
use app\models\ActiveRecord\Widget\CarouselWidgetElement;
use app\models\Forms\Manage\Widgets\CarouselElementForm;

/**
 * Description of CarouselElementService
 *
 * @author kotov
 */
class CarouselElementService
{
    /**
     *
     * @var CarouselElementRepository
     */
    private $carouselElements;
    
    public function __construct(CarouselElementRepository $carouselElements)
    {
        $this->carouselElements = $carouselElements;
    }
    
    public function create(CarouselElementForm $form)
    {
        $element = CarouselWidgetElement::create($form->name, $form->filmId);
        if ($form->image) {
            $element->setImage($form->image);
        }
        $this->carouselElements->save($element);
        return $element;
    }
    
    public function edit(int $id, CarouselElementForm $form)
    {
        /** @var CarouselWidgetElement $element */
        $element = $this->carouselElements->findById($id);
        $element->edit($form->name, $form->filmId);
        if ($form->image) {
            $element->setImage($form->image);
        }
        $this->carouselElements->save($element);
    }
}
