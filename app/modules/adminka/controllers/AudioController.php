<?php

namespace app\modules\adminka\controllers;

use app\core\repositories\Media\AudioRepository;
use app\core\services\operations\Media\AudioService;
use app\models\Forms\Media\AudioMaterialForm;
use app\models\SearchModels\Media\AudioSearch;
use DomainException;
use Yii;

/**
 * Description of AudioController
 *
 * @author kotov
 */
class AudioController extends BaseAdminController
{
         /**
     *
     * @var AudioService
     */
    protected $service;
    /**
     *
     * @var AudioRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        AudioRepository $repository,
        AudioService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    } 
    
    public function actionIndex()
    {
        $searchModel = new AudioSearch();
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
        $audioContent = $this->findModel($this->repository, $id);
        $form = new AudioMaterialForm($audioContent);
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
        $form = new AudioMaterialForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $audioContent = $this->service->create($form);
                return $this->redirect(['view', 'id' => $audioContent->id]);
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
