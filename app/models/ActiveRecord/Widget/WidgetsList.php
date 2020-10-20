<?php

namespace app\models\ActiveRecord\Widget;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%widgets_list}}".
 *
 * @property int $id
 * @property string $name Название
 * @property string|null $class_name Полное имя класса виджета
 * @property int|null $activate Активен (да/нет)
 */
class WidgetsList extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%widgets_list}}';
    }

    /**
     * 
     * @param string $name
     * @param string $className
     * @param bool $status
     * @return \self
     */
    public static function create(
            string $name,
            string $className,
            bool $status):self
    {
        $widget = new WidgetsList();
        $widget->name = $name;
        $widget->class_name = $className;
        $widget->activate = $status;
        return $widget;
    }
    
    /**
     * 
     * @param string $name
     * @param string $className
     * @param bool $status
     * @return void
     */
    public function edit(
            string $name,
            string $className,
            bool $status
            ):void
    {
        $this->name = $name;
        $this->class_name = $className;
        $this->activate = $status;        
    }
}
