<?php

namespace app\modules\adminka\controllers;

use app\models\SearchModels\User\UserSearch;
use app\core\repositories\User\UserRepository;
use app\core\services\operations\User\UserService;
use app\models\Forms\Manage\User\UserForm;
use Yii;
/**
 * Description of UserController
 *
 * @author kotov
 */
class UserController extends BaseAdminController
{
    
    /**
     *
     * @var UserService
     */
    protected $service;
    /**
     *
     * @var UserRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        UserRepository $repository,
        UserService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }  
    
    public function actionIndex()
    {
        $searchModel = new UserSearch();
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
    
    public function actionUpdate($id) 
    {
        $model = $this->findModel($this->repository, $id);
        $form = new UserForm($model);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($id, $form);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $form,
            'user' => $model,
        ]); 
    }
}
