<?php

namespace app\modules\adminka\controllers;

use app\core\repositories\Media\VideoRepository;
use app\core\services\operations\Media\VideoService;
use app\models\Forms\Media\VideoFileForm;
use app\models\Forms\Media\VideoMaterialForm;
use app\models\SearchModels\Media\VideoSearch;
use DomainException;
use Yii;

/**
 * Description of VideoController
 *
 * @author kotov
 */
class VideoController extends BaseAdminController
{
     /**
     *
     * @var VideoService
     */
    protected $service;
    /**
     *
     * @var VideoRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        VideoRepository $repository,
        VideoService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }   
    
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($this->repository,$id),
        ]);
    }
    
    public function actionUpdate($id)
    {
        $videoContent = $this->findModel($this->repository, $id);
        $form = new VideoMaterialForm($videoContent);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($$id, $form);
            return $this->redirect(['view', 'id' => $country->id]);
        }
        return $this->render('update', [
            'model' => $form,
        ]); 
        
                
    }

    public function actionCreate()
    {
        $form = new VideoMaterialForm();
       
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $videoContent = $this->service->create($form);
                return $this->redirect(['view', 'id' => $videoContent->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
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
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }
    
}
