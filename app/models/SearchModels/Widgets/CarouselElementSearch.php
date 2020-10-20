<?php

namespace app\models\SearchModels\Widgets;

use app\models\ActiveRecord\Widget\CarouselWidgetElement;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description of CarouselElementSearch
 *
 * @author kotov
 */
class CarouselElementSearch extends Model
{
    public function search(array $params): ActiveDataProvider
    {
        $query = CarouselWidgetElement::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;
    }    
}

