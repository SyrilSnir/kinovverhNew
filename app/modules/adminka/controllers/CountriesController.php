<?php

namespace app\modules\adminka\controllers;

use app\core\services\operations\CountryService;
use app\core\repositories\Geografy\CountryRepository;
use app\models\SearchModels\Geografy\CountrySearch;
use app\models\Forms\Manage\Geografy\CountryForm;
use Yii;

/**
 * Description of CountriesController
 *
 * @author kotov
 */
class CountriesController extends BaseAdminController
{
    /**
     *
     * @var CountryService
     */
    protected $service;
    /**
     *
     * @var CountryRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        CountryRepository $repository,
        CountryService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }
    
    public function actionIndex()
    {
        $searchModel = new CountrySearch();
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
            'country' => $this->findModel($this->repository,$id),
        ]);
    }
    
    public function actionUpdate($id)
    {
         $country = $this->findModel($this->repository, $id);
         $form = new CountryForm($country);
         if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($$id, $form);
            return $this->redirect(['view', 'id' => $country->id]);
        }
        return $this->render('update', [
            'model' => $form,
            'country' => $country,
        ]);         
    }
    
    public function actionCreate()
    {
        $form = new CountryForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $country = $this->service->create($form);
                return $this->redirect(['view', 'id' => $country->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }
    public function actionDelete($id)
    {
        $this->service->remove($id);
        return $this->redirect(['index']);
    }
}
