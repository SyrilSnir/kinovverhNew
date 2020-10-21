<?php

namespace app\core\services\operations\Audio;

use app\core\repositories\Audio\AlbumRepository;
use app\models\ActiveRecord\Audio\Album;
use app\models\ActiveRecord\Audio\AlbumGenre;
use app\models\ActiveRecord\Audio\AlbumSinger;
use app\models\Forms\Manage\Audio\AlbumForm;

/**
 * Description of AlbumService
 *
 * @author kotov
 */
class AlbumService
{
    
    /**
     *
     * @var AlbumRepository
     */
    protected $albums;
    
    /**
     *
     * @var GenreService
     */
    protected $genreService;
    
    /**
     *
     * @var SingerService
     */
    protected $singerService;

    public function __construct(
        AlbumRepository $albumRepository,
        GenreService $genreService,
        SingerService $singerService
            )
    {
        $this->albums = $albumRepository;
        $this->genreService = $genreService;
        $this->singerService = $singerService;
    }

    public function create(AlbumForm $form)
    {
        $album = Album::create(
                $form->name, 
                $form->code, 
                $form->description, 
                $form->year
                );
        if ($form->imageFile) {
            $album->setImage($form->imageFile);
        }
        $this->albums->save($album);
        if ($form->imageFile) {
          $album->image_url = $album->getUploadedFileUrl('image');
          $album->image_path = $album->getUploadedFilePath('image');
          $this->albums->save($album);
        }
        $this->savePostProcess($album, $form);        
        return $album;                           
    }
    
    public function edit($id, AlbumForm $form)
    {
        /* @var $album Album */
        $album = $this->albums->findById($id);
        $album->edit(
                $form->name, 
                $form->code, 
                $form->description, 
                $form->year
                );
        if ($form->imageFile) {
            $album->setImage($form->imageFile);
        }
        $this->albums->save($album);               
        $this->savePostProcess($album, $form);
    }

    public function remove($id)
    {
        /* @var $album Album */
        $album = $this->albums->findById($id);
        $this->albums->remove($album);  
        
    } 
    
    protected function savePostProcess(Album $album, AlbumForm $form)
    {       
        $this->setGenres($album->id, $form->genreList);
        $this->setSingers($album->id, $form->singersList);
    }
    
    protected function setGenres(int $albumId, array $genreList) 
    {
        $this->genreService->clearGenresForAlbum($albumId);
        foreach ($genreList as $genreId)
        {
            $model = AlbumGenre::create($albumId, $genreId);
            $model->save();
        }
        return $this;
    }
    
    protected function setSingers(int $albumId, array $singersList) 
    {
        $this->singerService->clearSingersForAlbum($albumId);
        foreach ($singersList as $singerId)
        {
            $model = AlbumSinger::create($albumId, $singerId);
            $model->save();
        }
        return $this;
    }    
}
