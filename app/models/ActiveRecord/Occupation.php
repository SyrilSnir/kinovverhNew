<?php

namespace app\models\ActiveRecord;

use yii\db\ActiveRecord;

/**
 * Модель содержит справочник родов деятельности
 * @property integer $id
 * @property string $name
 * @author kotov
 */
class Occupation extends ActiveRecord
{
    /** Режиссер */
    const KV_EDITOR = 1;
    /** Актёр */
    const KV_ACTOR = 2;
}
