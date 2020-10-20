<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\traits\Lists;

use app\models\ActiveRecord\Film\Film;
use yii\helpers\ArrayHelper;

/**
 *
 * @author kotov
 */
trait FilmsListTrait
{
    /**
     * 
     * @return array
     */
    public function filmsList():array
    {
        return ArrayHelper::map(Film::find()->orderBy('id')->asArray()->all(), 'id', 'name');
    }
    
    /**
     * 
     * @return array
     */
    public function filmsListWithNotSelected():array
    {
        return ArrayHelper::merge(['' => 'Не выбран'], $this->filmsList());
    }
}
