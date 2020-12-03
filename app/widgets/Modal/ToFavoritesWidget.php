<?php

namespace app\widgets\Modal;

/**
 * Description of ToFavoritesWidget
 *
 * @author kotov
 */
class ToFavoritesWidget extends BaseModal
{
    protected $filmId = null;
    protected $modalId = 'pop-favorite';
    protected $apiMethod = 'to-favorite';
    protected $oppositeButtonClass = 'del-favorite';
    
}
