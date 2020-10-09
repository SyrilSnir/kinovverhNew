<?php

namespace app\models\ActiveRecord;

use Yii;

/**
 * This is the model class for table "{{%user_types}}".
 *
 * @property int $id
 * @property string $name Название типа пользователя
 * @property string $slug Идентификатор типа пользователя
 */
class UserType extends \yii\db\ActiveRecord
{
    const ROOT_USER_TYPE = 'admin';
    const DEFAULT_USER_TYPE = 'user';
    
    const DEFAULT_USER_ID = 2;
    const ROOT_USER_ID = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_types}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
        ];
    }
}
