<?php

namespace app\core\repositories\Films;

use app\models\ActiveRecord\Film\Znak;
use app\core\exceptions\NotFoundException;
use app\core\repositories\RepositoryInterface;
use app\models\ActiveRecord\Film\Genre;
use app\models\ActiveRecord\Film\Category;

use app\core\repositories\DataManipulationTrait;
/**
 * Description of CategoriesRepository
 *
 * @author kotov
 */
class CategoriesRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id)
    {
        return Znak::find()
            ->andWhere(['id' => $id])
            ->one();
    }
    
    public function getCategoryByCode($code) : Category
    {
        if (!$category = Znak::findOne(['code' => $code])) {
            if (!$category = Genre::findOne(['code' => $code])) {
                throw new NotFoundException('Не верный идентификатор категории');
            }
       }
       return $category;
       
    }
    
    

}
