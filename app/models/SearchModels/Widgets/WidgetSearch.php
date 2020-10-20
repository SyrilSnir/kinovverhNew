<?php

namespace app\models\SearchModels\Widgets;

use app\models\ActiveRecord\Widget\WidgetsList;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description of WidgetSearch
 *
 * @author kotov
 */
class WidgetSearch extends Model
{
    public $name;
    
    public $activate;


    public function rules(): array
    {
        return [
            [['name'], 'safe'],
            [['activate'], 'safe'],
        ];
    }    
    public function search(array $params): ActiveDataProvider
    {
        $query = WidgetsList::find();
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
        $query->andFilterWhere(['like','name', $this->name]);
        $query->andFilterWhere(['activate' => $this->activate]);
        return $dataProvider;
    }    
}
