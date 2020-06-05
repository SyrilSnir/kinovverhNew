<?php

namespace app\models\Forms\Manage\User;

use yii\base\Model;
use app\models\ActiveRecord\User;

/**
 * Description of UserForm
 *
 * @author kotov
 */
class UserForm extends Model
{
    public $id;
    public $login;
    public $fio;
    public $birthday;
    
    public function __construct(User $user = null, $config = array())
    {
        if ($user) {
            $this->id = $user->id;
            $this->login = $user->login;
            $this->birthday = $user->birthday;
            $this->fio = $user->fio;
        }
        parent::__construct($config);
    }
    
    public function rules(): array
    {
        return [
            ['birthday', 'integer'],
            ['fio', 'safe'],
            [
                ['login'],
                    'unique',
                    'targetClass'=> User::class,
                    'filter' => 'id != '.$this->id,
                    'message' => 'Пользователь с указанными данными уже зарегистрирован'
            ],  
        ];
    }

    

    public function attributeLabels(): array
    {
        return [
            'login' => 'Логин (E-mail)',
            'fio' => 'ФИО',
            'birthday' => 'Дата рождения'
        ];
    }
}
