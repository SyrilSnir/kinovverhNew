<?php

namespace app\core\repositories\Widgets;

use app\core\repositories\DataManipulationTrait;
use app\core\repositories\RepositoryInterface;
use app\models\ActiveRecord\Widget\CarouselWidgetElement;
use yii\db\ActiveQuery;

/**
 * Description of CarouselElemensRepository
 *
 * @author kotov
 */
class CarouselElementRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    /**
     * 
     * @param int $id
     * @return ActiveQuery
     */
    public static function findById($id)
    {
        return CarouselWidgetElement::find()
            ->andWhere(['id' => $id])
            ->one();
    }     
}
