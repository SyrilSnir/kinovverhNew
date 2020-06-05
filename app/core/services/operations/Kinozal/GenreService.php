<?php

namespace app\core\services\operations\Kinozal;

use app\models\ActiveRecord\Film\Genre;
use app\models\ActiveRecord\Film\FilmGenre;
use app\core\repositories\Films\GenreRepository;
use app\models\Forms\Manage\Films\GenreForm;

/**
 * Description of GenreService
 *
 * @author kotov
 */
class GenreService
{
    /**    
     * @param GenreRepository $genres
     */
    protected $genres;
           
    public function __construct(GenreRepository $genres)
    {
        $this->genres = $genres; 
    }

    /**
     * 
     * @param GenreForm $form
     * @return Genre
     */
    public function create($form)
    {
        $genre = Genre::create(
            $form->name,
            $form->code);
        if (!$genre->save()) {
            throw new \RuntimeException('Ошибка сохранения.');        
        }
        return $genre;   
    }
    
    public function edit($id, GenreForm $form)
    {
        /* @var $genre Genre */
        $genre = $this->genres->findById($id);
        $genre->edit($form->name, $form->code);  
        $this->genres->save($genre);
    }
    
    public function remove ($id) 
    {
        /* @var $genre Country */
         $genre = $this->genres->findById($id);
         $this->genres->remove($genre);
    }
    
    public function clearGenresForFilm(int $filmId) 
    {
        FilmGenre::deleteAll([
            'film_id' => $filmId
        ]);
    }
}