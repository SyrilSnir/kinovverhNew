<?php

namespace app\core\services\operations\Audio;

use app\models\ActiveRecord\Audio\Genre;
use app\models\ActiveRecord\Audio\AlbumGenre;
use app\core\repositories\Audio\GenreRepository;
use app\models\Forms\Manage\Audio\GenreForm;

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
        /* @var $genre Genre */
         $genre = $this->genres->findById($id);
         $this->genres->remove($genre);
    }
    
    public function clearGenresForAlbum(int $albumId) 
    {
        AlbumGenre::deleteAll([
            'album_id' => $albumId
        ]);
    }
    
}