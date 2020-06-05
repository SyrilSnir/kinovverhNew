<?php

namespace app\core\services\operations\Media;

use app\models\Forms\Media\TrailersForm;
use app\models\ActiveRecord\Media\Trailers;
use app\core\repositories\Media\TrailersRepository;


/**
 * Description of TrailersService
 *
 * @author kotov
 */
class TrailersService
{
    /**
     *
     * @var TrailersRepository
     */
    public $repository;
    
    public function __construct(TrailersRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function addFiles($filmId, TrailersForm $trailersForm)
    {
        $imagesList = $this->repository->getImagesByFilmId($filmId);
        $sortIndex = count($imagesList);
        if (empty($trailersForm->files)) {
            throw new DomainException('Отсутствуют выбрвнные файлы');
        }
        foreach ($trailersForm->files as $file) {
            $trailersModel = Trailers::create($filmId, $sortIndex++, $file);
            $trailersModel->save();
            $trailersModel->file_path = $trailersModel->getUploadedFilePath('file');
            $trailersModel->url = $trailersModel->getUploadedFileUrl('file');
            $trailersModel->save();
        }
    }
    
    public function remove($id)
    {
        /** @var Trailers $trailers */
        $trailers = $this->repository->findById($id);
        $this->repository->remove($trailers);
    }
}
