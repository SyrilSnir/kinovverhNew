<?php

namespace app\models\Forms\User;

use yii\base\Model;
use app\models\ActiveRecord\User;

/**
 * Description of RegisterForm
 *
 * @author kotov
 */
class RegisterForm extends Model
{
    public $login;
    public $password;
    public $password_repeat;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password','password_repeat'], 'required'],
            ['login', 'email'],
            [ 
                'login',
                'unique',
                'targetClass' => User::class ,
                'message' => 'Польователь с таким адресом уже зарегистрирован'
            ],
            ['password_repeat',  'compare', 'compareAttribute'=>'password','message' => 'Введенные пароли не совпадают'],
        ];
    }
    
    /**
     * Названия полей
     * @return array
     */
    public function attributeLabels() {
        return [
            'login' => 'E-mail',
            'password' => 'Пароль',
            'password' => 'Подтверждение пароля',
        ];
    }
    
}
