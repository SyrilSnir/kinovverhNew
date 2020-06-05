<?php

namespace app\models\SearchModels\Films;

use yii\base\Model;
use app\models\ActiveRecord\Film\Film;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\ActiveRecord\Country;

/**
 * Description of FilmSearch
 *
 * @author kotov
 */
class FilmSearch extends Model
{
    public $id;
    public $name;
    public $country_id;


    public function rules() : array
    {
        return [
            [['name'],'safe'],
            [['country_id'],'integer'],
        ];
    }
    
    public function search(array $params) : ActiveDataProvider
    {
        $query = Film::find();
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
                'country_id' => $this->country_id
            ])->andFilterWhere([
                'like','name', $this->name
            ]);                
        return $dataProvider;        
    }
    
    public function countriesList(): array
    {
        return ArrayHelper::map(Country::find()->asArray()->all(),'id','name');
    }
}
