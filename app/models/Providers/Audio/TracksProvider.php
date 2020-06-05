<?php

namespace app\models\Providers\Audio;

use yii\data\ActiveDataProvider;
use app\models\ActiveRecord\Audio\Track;
/**
 * Description of TracksProvider
 *
 * @author kotov
 */
class TracksProvider
{
    public static function albumTrackList(int $albumId) : ActiveDataProvider
    {
        $query = Track::find()->andWhere(['album_id' => $albumId]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'track_num' => SORT_ASC
                ]
            ]
        ]);
        return $dataProvider;
    }
}
