<?php

namespace app\core\services\operations\Widget;

use app\core\repositories\Widgets\CarouselElementRepository;
use app\models\ActiveRecord\Widget\CarouselWidgetElement;
use app\models\Forms\Manage\Widgets\CarouselElementForm;
use yii\helpers\FileHelper;

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
    
    public function remove(int $id)
    {
        /** @var CarouselWidgetElement $element */        
        $element = $this->carouselElements->findById($id);        
        $linkedFile = $element->getUploadedFilePath('image');
        if (is_file($linkedFile)) {
            FileHelper::unlink($linkedFile);
        }
        $this->carouselElements->remove($element);
    }
}
