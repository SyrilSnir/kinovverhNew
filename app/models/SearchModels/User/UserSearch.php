<?php

namespace app\models\SearchModels\User;

use app\models\ActiveRecord\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description of UserSearch
 *
 * @author kotov
 */
class UserSearch extends Model
{
    public $fio;
    public $birthday;
    
    public function rules(): array
    {
        return [
            [['fio'], 'safe'],
            [['birthday'], 'number'],
        ];
    }
    
    public function search(array $params): ActiveDataProvider
    {
        $query = User::find();
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
