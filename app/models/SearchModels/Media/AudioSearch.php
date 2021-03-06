<?php

namespace app\models\SearchModels\Media;

use yii\base\Model;
use app\models\ActiveRecord\Media\AudioContent;
use yii\data\ActiveDataProvider;

/**
 * Description of AudioSearch
 *
 * @author kotov
 */
class AudioSearch extends Model
{
    public $description;
    
    public function rules(): array
    {
        return [
            ['description','safe']
        ];
    }
    
    public function search(array $params): ActiveDataProvider
    {
        $query = AudioContent::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC]
            ]
        ]);
        $this->load($params);
                if (!$this->validate()) {
            $query->andWhere('0=1');
            return $dataProvider;
        }
        return $dataProvider;                
    }
}
