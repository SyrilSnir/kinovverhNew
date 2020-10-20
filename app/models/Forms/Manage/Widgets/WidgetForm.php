<?php

namespace app\models\Forms\Manage\Widgets;

use app\models\ActiveRecord\Widget\WidgetsList;
use app\widgets\KinovverhWidget;
use yii\base\Model;

/**
 * Description of WidgetForm
 *
 * @author kotov
 */
class WidgetForm extends Model
{
    public $name;
    
    public $className;
    
    public $status;
    
    public function __construct(WidgetsList $widget = null, $config = [])
    {
        if ($widget) {
            $this->name = $widget->name;
            $this->className = $widget->class_name;
            $this->status = $widget->activate;
        }
        parent::__construct($config);
    }
    
    public function rules(): array 
    {
        return [
            [['name','className'],'required'],
            ['status','boolean'],
            [['className'],'isClassExist']
        ];
    }
    
    public function attributeLabels(): array
    {
        return [
          'name'  => 'Название виджета',
          'className'  => 'Класс, содержащий виджет',
          'status' => 'Статус'
        ];
    }
    
    public function isClassExist($attr,$param):void
    {
        $className = $this->$attr;
        if (class_exists($className) && is_subclass_of($className, KinovverhWidget::class)) {
            return;
        }
        $this->addError($attr, 'Класс с заданным именем не существует или не является виджетом');
    }
}