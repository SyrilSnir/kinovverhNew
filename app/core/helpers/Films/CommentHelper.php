<?php

namespace app\core\helpers\Films;

use app\models\ActiveRecord\Film\FilmComment;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Description of CommentHelper
 *
 * @author kotov
 */
class CommentHelper
{
    public static function statusList(): array
    {
        return [
            FilmComment::STATUS_MODERATE => 'На модерации',
            FilmComment::STATUS_PUBLISHED => 'Опубликован'
        ];        
    }
    
    public static function getStatusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }
    
    public static function getStatusLabel($status)
    {
        switch ($status) {
            case FilmComment::STATUS_MODERATE:
                $className = 'label label-default';
                break;
            case FilmComment::STATUS_PUBLISHED:
                $className = 'label label-success';
                break;
            default:
                $className = 'label label-default';
                break;
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $className,
        ]);
        
    }
}
