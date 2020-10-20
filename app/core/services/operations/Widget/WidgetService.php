<?php

namespace app\core\services\operations\Widget;

use app\core\repositories\Widgets\WidgetRepository;
use app\models\ActiveRecord\Widget\WidgetsList;
use app\models\Forms\Manage\Widgets\WidgetForm;
use RuntimeException;

/**
 * Description of WidgetService
 *
 * @author kotov
 */
class WidgetService 
{
    /**
     *
     * @var WidgetRepository
     */
    protected $widgets;
    
    public function __construct(WidgetRepository $widgets)
    {
        $this->widgets = $widgets;
    }
    
    public function create(WidgetForm $form): WidgetsList
    {
        $widget = WidgetsList::create(
                $form->name, 
                $form->className, 
                $form->status);
        if (!$widget->save()) {
            throw new RuntimeException('Ошибка сохранения.');        
        }
        return $widget;         
    }
    
    public function edit($id, WidgetForm $form)
    {
        /** @var WidgetsList $widget */
        $widget = $this->widgets->findById($id);
        $widget->edit(
                $form->name, 
                $form->className, 
                $form->status);
        $this->widgets->save($widget);
    }
    

}
