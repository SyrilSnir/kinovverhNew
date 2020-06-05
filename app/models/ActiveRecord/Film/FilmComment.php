<?php

namespace app\models\ActiveRecord\Film;

use yii\db\ActiveRecord;
use app\models\TimestampTrait;


/**
 * Description of FilmComment
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $film_id
 * @property string $message
 * @property integer $moderate
 * @property integer $created_at
 * @property integer $updated_at
 * 
 * @property Film $film Связанный с комментарием фильм
 * @author kotov
 */
class FilmComment extends ActiveRecord
{
    
    const STATUS_MODERATE = 0;
    const STATUS_PUBLISHED = 1;
    
    use TimestampTrait;        
    /**
     * 
     * @param int $filmId
     * @param string $userName
     * @param string $message
     * @return FilmComment
     */
    public static function create($filmId,$userName,$message)
    {
        $comment = new self();
        $comment->film_id = $filmId;
        $comment->user_name = $userName;
        $comment->message = $message;
        return $comment;
    }
    
    public function edit($filmId,$userName,$message) 
    {
        $this->film_id = $filmId;
        $this->user_name = $userName;
        $this->message = $message;
    }

    public static function tableName() 
    {
        return '{{%film_comment}}';
    }
    
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['id' => 'film_id']);
    }
    
    public function isPublished(): bool
    {
        return $this->moderate === self::STATUS_PUBLISHED;
    }
    
    public function isModerate(): bool
    {
        return $this->moderate === self::STATUS_MODERATE;
    }
    
    public function publish()
    {
        if ($this->isPublished()) {
            throw new DomainException('Комментарий уже опубликован');
        }
        $this->moderate = self::STATUS_PUBLISHED;
    }
    
    public function unpublish() {
        if ($this->isModerate()) {
            throw new DomainException('Комментарий не был опубликован');
        }
        $this->moderate = self::STATUS_MODERATE;
    }
    
    
    
    
}
