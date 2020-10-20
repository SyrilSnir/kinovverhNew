<?php

namespace app\modules\adminka\modules\widgets\controllers;

use app\core\repositories\Widgets\WidgetRepository;
use app\core\services\operations\Widget\WidgetService;
use app\models\Forms\Manage\Widgets\WidgetForm;
use app\models\SearchModels\Widgets\WidgetSearch;
use app\modules\adminka\controllers\BaseAdminController;
use DomainException;
use Yii;

/**
 * Description of SettingsController
 *
 * @author kotov
 */
class SettingsController extends BaseAdminController
{
    /**
     *
     * @var WidgetService
     */
    protected $service;
    /**
     *
     * @var WidgetRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        WidgetRepository $repository,
        WidgetService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }    
    
    public function actionIndex()
    {
        $searchModel = new WidgetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
    
    public function actionCreate()
    {
        $form = new WidgetForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $country = $this->service->create($form);
                return $this->redirect(['view', 'id' => $country->id]);
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
         $country = $this->findModel($this->repository, $id);
         $form = new WidgetForm($country);
         if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($id, $form);
            return $this->redirect(['view', 'id' => $country->id]);
        }
        return $this->render('update', [
            'model' => $form,
            'country' => $country,
        ]);         
    }    
}
