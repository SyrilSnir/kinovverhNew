<?php

namespace app\models\ActiveRecord\Film;

use yii\db\ActiveRecord;

/**
 * Description of Favorites
 *
 * @property integer $user_id
 * @property integer $film_id
 * @author kotov
 */
class Favorites extends ActiveRecord
{
    public static function tableName() 
    {
        return '{{%favorites_films}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'film_id'], 'required'],
            [['user_id', 'film_id'], 'integer'],
            [['user_id', 'film_id'], 'unique', 'targetAttribute' => ['user_id', 'film_id']],
        ];
    }  
    
    /**
     * 
     * @param int $userId
     * @param int $filmId
     * @return \self
     */
    public static function create(int $userId, int $filmId):self
    {
        $model = new self();
        $model->user_id = $userId;
        $model->film_id = $filmId;
        return $model;
    }
}
