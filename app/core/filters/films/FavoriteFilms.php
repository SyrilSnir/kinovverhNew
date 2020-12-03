<?php

namespace app\core\filters\films;

use app\core\repositories\Films\FilmList;
use app\core\repositories\Films\FilmRepository;
use app\models\ActiveRecord\User;

/**
 * Description of FavoriteFilms
 *
 * @author kotov
 */
class FavoriteFilms implements FilmListFilterInterface
{    
    /**
     *
     * @var User
     */
    private $user;
    
    /**
     *
     * @var FilmRepository
     */
    protected $repository;
    
    /**
     * 
     * @param int $userId ID пользователя
     */
    public function __construct(FilmRepository $repository, User $user)
    {
        $this->user = $user;
        $this->repository = $repository;
    }

    public function getAll()
    {
        $filmsList = $this->repository->getFavorites($this->user);
        return [new FilmList($filmsList,'Избранное')];
    }

}
