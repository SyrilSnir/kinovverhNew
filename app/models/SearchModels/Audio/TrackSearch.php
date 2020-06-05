<?php

namespace app\models\SearchModels\Audio;

use app\models\ActiveRecord\Audio\Track;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description of TrackSearch
 *
 * @author kotov
 */
class TrackSearch extends Model
{
    public $id;
    public $name;
    public $year;
    
    public function rules() : array
    {
        return [
            [['name'],'safe'],
            [['year'],'integer'],
        ];
    }
    
    public function search(array $params) : ActiveDataProvider
    {
        $query = Track::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC
                ]
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
                'year' => $this->year
            ])->andFilterWhere([
                'like','name', $this->name
            ]);                
        return $dataProvider;        
    }
}
