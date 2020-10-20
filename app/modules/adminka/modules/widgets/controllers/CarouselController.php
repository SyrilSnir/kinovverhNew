<?php

namespace app\modules\adminka\modules\widgets\controllers;

use app\core\repositories\Widgets\CarouselElementRepository;
use app\core\services\operations\Widget\CarouselElementService;
use app\models\Forms\Manage\Widgets\CarouselElementForm;
use app\models\SearchModels\Widgets\CarouselElementSearch;
use app\modules\adminka\controllers\BaseAdminController;
use DomainException;
use Yii;

/**
 * Description of CarouselController
 *
 * @author kotov
 */
class CarouselController extends BaseAdminController
{
    /**
     *
     * @var CarouselElementService
     */
    protected $service;
    /**
     *
     * @var CarouselElementRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        CarouselElementRepository $repository,
        CarouselElementService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    } 
    
    public function actionIndex()
    {
        $searchModel = new CarouselElementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }  
    
    public function actionCreate()
    {
        $form = new CarouselElementForm();
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

    public function actionUpdate($id)
    {
        $model = $this->findModel($this->repository, $id);
        $form = new CarouselElementForm($model);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($id, $form);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $form,
        ]);                         
    }    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($this->repository,$id),
        ]);
    }    
}
