<?php

namespace app\models\Forms\Comments;

use yii\base\Model;

/**
 * Description of CommentForm
 *
 * @author kotov
 */
class CommentForm extends Model
{
    public $userId;
    public $userName;
    public $filmId;
    public $message;
    public $filmSlug;

    public function attributeLabels() 
    {
        return [
            'userName' => 'Ваше имя'
        ];
    }
    public function rules() 
    {
        return [
            [['userName','message','filmSlug'],'required'],
            ['filmId','number'],
            ['message','string'],
            ['filmSlug','string'],
        ];
        
    }
}
