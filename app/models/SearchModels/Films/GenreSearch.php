<?php

namespace app\models\SearchModels\Films;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActiveRecord\Film\Genre;

/**
 * Description of GenreSearche
 *
 * @author kotov
 */
class GenreSearch extends Model
{
    public $name;
    public $code;
    
    public function rules(): array
    {
        return [
            [['name','code'], 'safe'],
        ];
    }
    
    public function search(array $params): ActiveDataProvider
    {
        $query = Genre::find();
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
        $query->andFilterWhere(['like','code', $this->code]);
        return $dataProvider;
    }
}
