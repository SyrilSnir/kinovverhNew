<?php

namespace app\models\SearchModels\Films;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActiveRecord\Film\FilmComment;
use app\models\ActiveRecord\Film\Film;
use app\core\helpers\Films\CommentHelper;
use yii\helpers\ArrayHelper;
/**
 * Description of CommentsSearch
 *
 * @author kotov
 */
class CommentsSearch extends Model
{    
    public $id;
    public $user_name;
    public $message;
    public $film_id;
    public $moderate;


    public  function rules(): array 
    {
        return [
            [['user_name', 'message'],'safe'] ,
            [['film_id','moderate'], 'integer']
        ];
        
    }
    
    public function search(array $params) : ActiveDataProvider
    {
        $query = FilmComment::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query
                ->andFilterWhere([
                    'film_id' => $this->film_id,
                    'moderate' => $this->moderate,          
                ])
                ->andFilterWhere(['like', 'user_name', $this->user_name])
                ->andFilterWhere(['like', 'message', $this->message]);
        return $dataProvider;
    }
    public function filmsList(): array
    {
        return ArrayHelper::map(Film::find()->asArray()->all(),'id','name');
    }
    
    public function statusList()
    {
        return CommentHelper::statusList();
    }            
}
