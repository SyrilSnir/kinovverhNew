<?php

namespace app\models\ActiveRecord\Film;

/**
 * Хранит знаки информационной продукции
 * @author kotov
 */
class Znak extends Category
{
    public static function tableName(): string
    {
        return '{{%categories}}';
    }

    public function getFilms()
    {
        return $this->hasMany(Film::class, ['category_id' => 'id'])
                ->all();
    }

}
