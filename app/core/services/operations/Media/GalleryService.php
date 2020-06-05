<?php

namespace app\core\services\operations\Media;

use app\models\Forms\Media\GalleryForm;
use app\models\ActiveRecord\Media\Gallery;
use app\core\repositories\Media\GalleryRepository;

/**
 * Description of GalleryService
 *
 * @author kotov
 */
class GalleryService
{
    /**
     *
     * @var GalleryRepository
     */
    public $repository;
    
    public function __construct(GalleryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addFiles($filmId, GalleryForm $galleryForm)
    {
        $imagesList = $this->repository->getImagesByFilmId($filmId);
        $sortIndex = count($imagesList);
        if (empty($galleryForm->files)) {
            throw new DomainException('Отсутствуют выбрвнные файлы');
        }
        foreach ($galleryForm->files as $file) {
            $galleryModel = Gallery::create($filmId, $sortIndex++, $file);
            $galleryModel->save();
            $galleryModel->file_path = $galleryModel->getUploadedFilePath('file');
            $galleryModel->url = $galleryModel->getUploadedFileUrl('file');
            $galleryModel->save();
        }
    }
    
    public function remove($id)
    {
        /** @var Gallery $gallery */
        $gallery = $this->repository->findById($id);
        $this->repository->remove($gallery);
    }
    
    
}
