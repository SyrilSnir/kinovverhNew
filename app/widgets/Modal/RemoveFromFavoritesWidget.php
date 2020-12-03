<?php

namespace app\widgets\Modal;

/**
 * Description of RemoveFromFavoritesWidget
 *
 * @author kotov
 */
class RemoveFromFavoritesWidget extends BaseModal
{
    protected $filmId = null;
    protected $modalId = 'pop-favorite-remove';
    protected $apiMethod = 'remove-from-favorites';
    protected $oppositeButtonClass = 'in-favorite';
}
