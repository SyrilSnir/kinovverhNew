<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kv_favorites_films".
 *
 * @property int $user_id Id пользователя
 * @property int $film_id Id фильма
 */
class FavoriteFilms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kv_favorites_films';
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'film_id' => 'Film ID',
        ];
    }
}
