<?php

namespace app\models\ActiveRecord;

use app\models\TimestampTrait;
use yii\db\ActiveRecord;
use Yii;

/**
 * User model
 * 
 * @property integer $id
 * @property string $login
 * @property string $fio
 * @property string $password_hash write-only password 
 * @property string $auth_key
 * @property string $birthday
 * @property integer $bitrix_user
 * @property integer $external
 * @property boolean $active
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    
    use TimestampTrait;
    
    public static function create(
            $login,
            $password,
            $fio = ''
            ) :User
    {
        $user = new self();
        $user->login = $login;
        $user->fio = $fio;

        $user->setPassword($password);
        $user->setAuthKey();
        return $user;                        
    }
    
    public function edit(
            $login,
            $fio,
            $birthday
            )
    {
        $this->login = $login;
        $this->fio = $fio;
        $this->birthday = $birthday;
    }

    public static function tableName() 
    {
        return '{{%users}}';
    }
    
    public function setPassword($password) 
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
      
    public function validatePassword($password):bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    public function setAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
