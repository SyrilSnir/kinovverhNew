<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\repositories;

use yii\db\ActiveRecord;
/**
 *
 * @author kotov
 */
trait DataManipulationTrait
{
    /**
     * 
     * @param ActiveRecord $model
     * @throws RuntimeException
     */
    public function save($model)
    { 
       if (!$model->save()) {
            throw new RuntimeException('Ошибка сохранения');
        }
    }
    
    /**
     * 
     * @param ActiveRecord $model
     * @throws RuntimeException
     */
    public function remove($model) 
    {
        if (!$model->delete()) {
            throw new RuntimeException('Ошибка удаления');
        }
    }
}
