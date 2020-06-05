<?php

namespace app\core\filters\films;

use app\core\repositories\Films\FilmList;

/**
 *
 * @author kotov
 */
interface FilmListFilterInterface
{
    /**
     * @return FilmList[]
     */
    public function getAll();
}
