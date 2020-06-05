<?php

namespace app\modules\adminka\controllers;

use app\core\services\operations\Audio\AlbumService;
use app\core\repositories\Audio\AlbumRepository;
use app\models\Forms\Manage\Audio\AlbumForm;
use app\models\SearchModels\Audio\AlbumSearch;
use app\models\Providers\Audio\TracksProvider;
use Yii;

/**
 * Description of AlbumsController
 *
 * @author kotov
 */
class AlbumsController extends BaseAdminController
{
    /**
     *
     * @var AlbumService
     */
    protected $service;    
    /**
     *
     * @var AlbumRepository
     */
    protected $repository;
    
    public function __construct(
            $id, 
            $module, 
            AlbumRepository $repository,
            AlbumService $service,
            $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }
    
    public function actionIndex() 
    {
        $searchModel = new AlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $form = new AlbumForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $album = $this->service->create($form);
                return $this->redirect(['view', 'id' => $album->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }
    
    public function actionUpdate($id)
    {
         $album = $this->findModel($this->repository, $id);
         $form = new AlbumForm($album);
         if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($this->repository->findById($id), $form);
            return $this->redirect(['view', 'id' => $album->id]);
        }
        return $this->render('update', [
            'model' => $form,
        ]);         
    }
    
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $tracksProvider = TracksProvider::albumTrackList($id);
        return $this->render('view', [
            'album' => $this->findModel($this->repository,$id),
            'tracksProvider' => $tracksProvider
        ]);
    }
    
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

}
