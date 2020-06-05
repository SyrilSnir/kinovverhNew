<?php

namespace app\models\Forms\User;

use app\models\ActiveRecord\User;
use yii\base\Model;

/**
 * Description of LoginForm
 *
 * @author kotov
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    public $rememberMe = false;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // login and password are both required
            [['login', 'password'], 'required'],

        ];
    }
    /**
     * Названия полей
     * @return array
     */
    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль'
        ];
    }
}
