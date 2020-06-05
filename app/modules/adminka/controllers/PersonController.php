<?php

namespace app\modules\adminka\controllers;


use app\core\services\operations\Person\PersonService;
use app\core\repositories\PersonRepository;
use app\models\SearchModels\PersonSearch;
use app\models\Forms\Manage\PersonForm;
use Yii;

/**
 * Description of PersonController
 *
 * @author kotov
 */
class PersonController extends BaseAdminController
{
    /**
     *
     * @var PersonService
     */
    protected $service;
    /**
     *
     * @var PersonRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        PersonRepository $repository,
        PersonService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }    
    
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
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
        $form = new PersonForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $person = $this->service->create($form);
                return $this->redirect(['view', 'id' => $person->id]);
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
         $model = $this->findModel($this->repository, $id);
         $form = new PersonForm($model);
         if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($id, $form);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $form,
            'person' => $model,
        ]);  
    }
    
    public function actionDelete($id)
    {
        $this->service->remove($id);
        return $this->redirect(['index']);
    }
}
