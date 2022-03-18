<?php

namespace app\core\services\operations\Kinozal;

use app\core\repositories\Films\FavoriteFilmsRepository;
use app\core\repositories\Films\FilmRepository;
use app\core\repositories\Media\MediaRepository;
use app\core\services\operations\Kinozal\GenreService;
use app\core\services\operations\Person\FilmPersonOccupationService;
use app\models\ActiveRecord\Film\Favorites;
use app\models\ActiveRecord\Film\Film;
use app\models\ActiveRecord\Film\FilmGenre;
use app\models\ActiveRecord\Media\Kinopanorama;
use app\models\ActiveRecord\Media\Media;
use app\models\ActiveRecord\Occupation;
use app\models\ActiveRecord\Person\FilmPersonOccupation;
use app\models\Forms\Manage\Films\FilmCreateForm;
use app\models\Forms\Manage\Films\FilmEditForm;
use app\models\Forms\Manage\Films\FilmForm;
use yii\web\UploadedFile;

/**
 * Description of FilmService
 *
 * @author kotov
 */
class FilmService
{
    /**    
     * @var FilmRepository
     */
    protected $films;
    
    /**
     * @var FavoriteFilmsRepository 
     */
    protected $favoriteFilms;
    
    /**    
     * @var MediaRepository
     */
    protected $mediaRepository;
    
    /**    
     * @var GenreService $genreService
     */
    protected $genreService;
    
    /**     
     * @var FilmPersonOccupationService 
     */
    protected $filmPersonOccupationService;

    /**
     * 
     * @param MediaRepository $mediaRepository
     * @param FilmRepository $films
     * @param GenreService $genreService
     * @param FilmPersonOccupationService $filmPersonOccupationService
     */
    public function __construct(
            MediaRepository $mediaRepository, 
            FilmRepository $films,
            FavoriteFilmsRepository $favoriteFilms,
            GenreService $genreService,
            FilmPersonOccupationService $filmPersonOccupationService
            )
    {
        $this->films = $films; 
        $this->mediaRepository = $mediaRepository;
        $this->favoriteFilms = $favoriteFilms;
        $this->genreService = $genreService;
        $this->filmPersonOccupationService = $filmPersonOccupationService;
    }
    
    /**
     * 
     * @param FilmCreateForm $form
     * @return type
     */
    public function create(FilmCreateForm $form)
    {
        $film = Film::create(
                $form->name, 
                $form->code, 
                $form->previewText,
                $form->detailText,
                $form->media,
                $form->category,
                $form->country,
                $form->year,
                $form->time,
                $form->rating,                
                $form->kinopanoramaActive
            );
        if ($form->anonsImageFile) {
            $film->setAnonsImageFile($form->anonsImageFile);
        }
        
        if ($form->detailImageFile) {
            $film->setDetailImageFile($form->detailImageFile);
        }
        
        if ($form->kinopanoramaFile) {
            $film->setKinopanoramaFile($form->kinopanoramaFile);
        }
        $this->films->save($film);
        $this->setAnonsImageUrl($film);
        $this->setDetailImageUrl($film);
        $this->savePostProcess($film, $form);
        return $film;
    }
    
    public function edit($id, FilmEditForm $form)
    {
        /* @var $film Film */
        $film = $this->films->findById($id);
        $film->edit(
                $form->name, 
                $form->code, 
                $form->previewText,  
                $form->detailText,
                $form->media,
                $form->category,
                $form->country,
                $form->year,
                $form->time,
                $form->rating,
                $form->kinopanoramaActive
                );
        if ($form->anonsImageFile) {
            $film->setAnonsImageFile($form->anonsImageFile);
        }
        
        if ($form->detailImageFile) {
            $film->setDetailImageFile($form->detailImageFile);
        }        
        
        if ($form->kinopanoramaFile) {
            $film->setKinopanoramaFile($form->kinopanoramaFile);
        }        
        $this->films->save($film);
        $this->setAnonsImageUrl($film);  
        $this->setDetailImageUrl($film);  
        $this->savePostProcess($film, $form);        
    }
    
    public function remove($id): void
    {
        /* @var $film Film */
        $film = $this->films->findById($id);
        $this->films->remove($film);
    }        

    /**
     * Добавить фильм в избранное
     * @param int $filmId ID фильма
     * @param int $userId ID пользователя
     * @return void
     */
    public function toFavorites(int $filmId, int $userId): void
    {
        $element = Favorites::findOne([
            'film_id' => $filmId,
            'user_id' => $userId
        ]);
        if (!$element) {
            $favoriteFilm = Favorites::create($userId, $filmId);
            $this->favoriteFilms->save($favoriteFilm);
        }
    }
    
    public function removeFromFavorites(int $filmId, int $userId):void
    {
        $element = $this->favoriteFilms->getField($filmId, $userId);
        if ($element) {
            $this->favoriteFilms->remove($element);
        }
    }


    protected function setKinopanoramaMediaField(Film $film, UploadedFile $mediaFile) 
    {
        $kinopanoramaMediaPath = $film->getUploadedFilePath('kinopanoramaFile');        
        if (!$kinopanoramaMediaPath) {
            return;
        }
        $kinopanoramaMediaUrl = $film->getUploadedFileUrl('kinopanoramaFile');
        if ($film->kinopanorama_id) {
            /** @var Media $mediaModel */
            $mediaModel = $this->mediaRepository->findKinopanoramaById($film->kinopanorama_id);
            $mediaModel->edit(
                    basename($kinopanoramaMediaPath),
                    'Кинопанорама');
            $this->mediaRepository->save($mediaModel);            
        } else {
            $mediaModel = Kinopanorama::create(
                    basename($kinopanoramaMediaPath),
                    'Кинопанорама'
                    );
            $this->mediaRepository->save($mediaModel);
            $film->kinopanorama_id = $mediaModel->id;
            $this->films->save($film);
        }
        
    }
    
    protected function setEditors(int $filmId, array $personsList)
    {
        $this->filmPersonOccupationService->clearEditors($filmId);
        $this->setPersonOccupation($filmId, Occupation::KV_EDITOR, $personsList);
        return $this;
    }
    
    protected function setActors(int $filmId, array $personsList)
    {
        $this->filmPersonOccupationService->clearActors($filmId);
        $this->setPersonOccupation($filmId, Occupation::KV_ACTOR, $personsList);
        return $this;
    }
    
    protected function setGenres(int $filmId, array $genreList) 
    {
        $this->genreService->clearGenresForFilm($filmId);
        foreach ($genreList as $genreId)
        {
            $model = FilmGenre::create($filmId, $genreId);
            $model->save();
        }
        return $this;
    }

    protected function setPersonOccupation(
            int $filmId,
            int $occupationId,
            array $personsList                
        )
    {        
        foreach ($personsList as $personId)
        {
            $model = FilmPersonOccupation::create($filmId, $personId, $occupationId);
            $model->save();
        }
    }
    
    protected function setAnonsImageUrl(Film $film)
    {
        $anonsImageUrl = $film->getUploadedFileUrl('anonsImageFile');            
        if ($anonsImageUrl) {
            $film->setAnonsImage($anonsImageUrl);            
            $this->films->save($film);
        }        
    }
    
    protected function setDetailImageUrl(Film $film)
    {
        $detailImageUrl = $film->getUploadedFileUrl('detailImageFile');            
        if ($detailImageUrl) {
            $film->setDetailImage($detailImageUrl);            
            $this->films->save($film);
        }        
    }    
    
    protected function savePostProcess(Film $film, FilmForm $form)
    {
        if ($form->kinopanoramaFile) {
            $this->setKinopanoramaMediaField($film, $form->kinopanoramaFile);
        }
        if (empty($form->editorsList)) {
            $form->editorsList = [];
        }                    
        if (empty($form->actorsList)) {
            $form->actorsList = [];
        }
        $this->setEditors($film->id, $form->editorsList)
                ->setActors($film->id, $form->actorsList)
                ->setGenres($film->id, $form->genreList);
    }
    
    
}
