<?php

namespace app\models\SearchModels\Audio;


use app\models\ActiveRecord\Audio\Album;
use yii\data\ActiveDataProvider;
use yii\base\Model;

/**
 * Description of AlbumSearch
 *
 * @author kotov
 */
class AlbumSearch extends Model
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
        $query = Album::find();
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
