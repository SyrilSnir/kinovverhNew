<?php

namespace app\core\helpers\Films;

use app\core\repositories\Films\FilmList;

/**
 *
 * @author kotov
 */
interface ShowFilmListInterface
{
    public function show();    
    public function addFilmList(FilmList $filmList);
    public function setFilmList(array $filmList);
}
