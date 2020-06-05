<?php

namespace app\core\manage\films;

use app\core\filters\films\FilmListFilterInterface;

/**
 * Description of FilmManager
 *
 * @author kotov
 */
class FilmManager
{
    /** @var FilmList[] Закешированный список фильмов */
    protected $filmsCache;
    
    /** @var FilmListFilterInterface  */
    protected $filmsFilter;
    
    public function __construct(FilmListFilterInterface $filmsFilter)
    {
        $this->filmsFilter = $filmsFilter;      
    }
    public function getList() 
    {
        if (empty($this->filmsCache)) {
            $this->filmsCache = $this->filmsFilter->getAll();
        }
        return $this->filmsCache;
    }
    
}
