<?php

namespace app\models\Forms\Manage\Films;

use app\models\ActiveRecord\Film\Film;
use app\models\ActiveRecord\Film\FilmComment;
use yii\helpers\ArrayHelper;
use yii\base\Model; 

/**
 * Description of CommentForm
 *
 * @author kotov
 */
class CommentForm extends Model
{
    public $filmId;
    public $userName;
    public $message;
    
    public function __construct(FilmComment $model = null, $config = array())
    {
        if ($model) {
            $this->filmId = $model->film_id;
            $this->userName = $model->user_name;
            $this->message = $model->message;
        }
        parent::__construct($config);
    }

    public function filmsList()
    {
        return ArrayHelper::map(Film::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function rules(): array
    {
        return [            
            [['filmId','userName'],'required'],
            [['filmId'],'integer'],
            [['userName','message'],'string']
        ];
    }
    
    public function attributeLabels(): array
    {
        return [
            'filmId' => 'Фильм',
            'userName' => 'Автор комментпария',
            'message' => 'Текст комментария'
        ];
    }
}
