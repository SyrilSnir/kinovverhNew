<?php

namespace app\models\SearchModels;

use app\models\ActiveRecord\Person;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description of PersonSearch
 *
 * @author kotov
 */
class PersonSearch extends Model
{
    public $name;
    public $year;
    
    public function rules(): array
    {
        return [
            [['name'], 'safe'],
            [['year'], 'number'],
        ];
    }
    
    public function search(array $params): ActiveDataProvider
    {
        $query = Person::find();
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
