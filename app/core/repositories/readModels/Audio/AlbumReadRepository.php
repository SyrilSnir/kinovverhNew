<?php

namespace app\core\repositories\readModels\Audio;

use app\core\repositories\readModels\ReadModelInterface;
use app\models\ActiveRecord\Audio\Album;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

/**
 * Description of AlbumReadRepository
 *
 * @author kotov
 */
class AlbumReadRepository implements ReadModelInterface
{
    public function getAll(): DataProviderInterface
    {
        $query = Album::find();
        return $this->getProvider($query);
    }
    
    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
