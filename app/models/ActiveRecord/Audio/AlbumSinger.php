<?php

namespace app\models\ActiveRecord\Audio;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%album_singers}}".
 *
 * @property int $id
 * @property int|null $album_id
 * @property int|null $person_id
 */
class AlbumSinger extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%album_singers}}';
    }

    /**
     * 
     * @param int $albumId If альбома
     * @param int $singerId Id исполнителя
     * @return \self
     */
    public static function create(int $albumId, int $singerId):self
    {
        $singer = new self;
        $singer->album_id = $albumId;
        $singer->person_id = $singerId;
        return $singer;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album_id', 'person_id'], 'integer'],
        ];
    }
}
