<?php

namespace app\core\services\operations\Kinozal;

use app\core\repositories\Films\FilmRepository;
use app\core\repositories\Media\MediaRepository;
use app\models\Forms\Manage\Films\FilmEditForm;
use app\models\Forms\Manage\Films\FilmCreateForm;
use app\models\Forms\Manage\Films\FilmForm;
use app\models\ActiveRecord\Film\Film;
use app\models\ActiveRecord\Film\FilmGenre;
use app\models\ActiveRecord\Person\FilmPersonOccupation;
use app\models\ActiveRecord\Occupation;
use app\models\ActiveRecord\Media\Media;
use app\models\ActiveRecord\Media\MediaCategory;
use app\core\services\operations\Person\FilmPersonOccupationService;
use app\core\services\operations\Kinozal\GenreService;
use yii\web\UploadedFile;

/**
 * Description of FilmService
 *
 * @author kotov
 */
class FilmService
{
    /**    
     * @var FilmRepository $films
     */
    protected $films;
    /**    
     * @var MediaRepository $mediaRepository
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

    public function __construct(
            MediaRepository $mediaRepository, 
            FilmRepository $films,
            GenreService $genreService,
            FilmPersonOccupationService $filmPersonOccupationService
            )
    {
        $this->films = $films; 
        $this->mediaRepository = $mediaRepository;
        $this->genreService = $genreService;
        $this->filmPersonOccupationService = $filmPersonOccupationService;
    }
    
    public function create(FilmCreateForm $form)
    {
        $film = Film::create(
                $form->name, 
                $form->code, 
                $form->previewText,
                $form->detailText,
                $form->category,
                $form->country,
                $form->media,
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
                $form->category,
                $form->country,
                $form->media,
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
    
    public function remove($id)
    {
        /* @var $film Film */
        $film = $this->films->findById($id);
        $this->films->remove($film);
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
            $mediaModel = $this->mediaRepository->findById($film->kinopanorama_id);
            $mediaModel->edit(
                    $film->kinopanoramaFile,
                    'Кинопанорама',
                    $kinopanoramaMediaPath, 
                    $kinopanoramaMediaUrl, 
                    $mediaFile->size, 
                    $mediaFile->type,
                    $mediaFile->extension,
                    MediaCategory::CATEGORY_KINOPANORAMA);
            $this->mediaRepository->save($mediaModel);            
        } else {
            $mediaModel = Media::create(
                    $film->kinopanoramaFile,
                    'Кинопанорама',
                    $kinopanoramaMediaPath,
                    $kinopanoramaMediaUrl,
                    $mediaFile->size, 
                    $mediaFile->type,
                    $mediaFile->extension,
                    MediaCategory::CATEGORY_KINOPANORAMA
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
