<?php

namespace app\core\repositories\Widgets;

use app\core\repositories\DataManipulationTrait;
use app\core\repositories\RepositoryInterface;
use app\models\ActiveRecord\Widget\WidgetsList;
use yii\db\ActiveQuery;

/**
 * Description of WidgetsRepository
 *
 * @author kotov
 */
class WidgetRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    /**
     * 
     * @param int $id
     * @return ActiveQuery
     */
    public static function findById($id)
    {
        return WidgetsList::find()
            ->andWhere(['id' => $id])
            ->one();
    } 
    
    public static function findByClassName(string $className)
    {
        return WidgetsList::find()
                ->andWhere(['class_name' => $className])
                ->one();
    }
}
