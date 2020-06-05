<?php

namespace app\modules\adminka\controllers;

use app\core\repositories\Audio\TrackRepository;
use app\core\services\operations\Audio\TrackService;
use app\models\SearchModels\Audio\TrackSearch;
use app\models\Forms\Manage\Audio\TrackForm;
use Yii;

/**
 * Description of TracksController
 *
 * @author kotov
 */
class TracksController extends BaseAdminController
{
    /**
     *
     * @var TrackService
     */
    protected $service;    
    /**
     *
     * @var TrackRepository
     */
    protected $repository;
    
    public function __construct(
            $id, 
            $module, 
            TrackRepository $repository,
            TrackService $service,
            $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }
    
    public function actionIndex() 
    {
        $searchModel = new TrackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        return $this->createTrack();
    }
    
    public function actionAddToAlbum($id)
    {
        return $this->createTrack($id);
    }
    
    public function editInAlbum($id)
    {
        return $this->updateTrack($id);
    }

    public function actionUpdate($id)
    {
        return $this->updateTrack($id);         
    }
    
    /**
    * @param integer $id
    * @return mixed
    */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($this->repository,$id),
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
    
    protected function createTrack($albumId = null)
    {
        $form = new TrackForm();
        $viewParams = [
            'model' => $form,           
        ];                   
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $album = $this->service->create($form);
                if ($albumId) {
                    return $this->redirect([ '/adminka/albums/view','id' => $albumId ]);
                }
                return $this->redirect(['view', 'id' => $album->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }        
        $viewParams['albumId'] = $albumId ? $albumId : false;
        return $this->render('create', $viewParams);
    }
    
    protected function updateTrack($id)
    {
         $track = $this->findModel($this->repository, $id);
         $form = new TrackForm($track);
         if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($this->repository->findById($id), $form);
            return $this->redirect(['view', 'id' => $track->id]);
        }
        return $this->render('update', [
            'model' => $form,
        ]);         
    }
}
