<?php

namespace app\modules\adminka\controllers;

use app\core\services\operations\Kinozal\CommentService;
use app\core\repositories\Films\CommentsRepository;
use app\models\SearchModels\Films\CommentsSearch;
use app\models\Forms\Manage\Films\CommentForm;
use Yii;

/**
 * Description of CommentsController
 *
 * @author kotov
 */
class CommentsController extends BaseAdminController
{
    /**
     *
     * @var CommentService
     */
    protected $service;    
    /**
     *
     * @var CommentsRepository
     */
    protected $repository;
    
    public function __construct(
            $id, 
            $module, 
            CommentsRepository $repository,
            CommentService $service,
            $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }
    
    public function actionIndex() 
    {
        $searchModel = new CommentsSearch();
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
            'comment' => $this->findModel($this->repository,$id),
        ]);
    }
    
    public function actionUpdate($id) 
    {
        $comment = $this->findModel($this->repository, $id);
        $form = new CommentForm($comment);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($comment->id, $form);
                return $this->redirect(['view', 'id' => $comment->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'comment' => $comment
        ]);
    }
    
    public function actionCreate() 
    {
        $form = new CommentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $comment = $this->service->create($form);
                return $this->redirect(['view', 'id' => $comment->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
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
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionPublish($id)
    {
        try {
            $this->service->publish($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionUnpublish($id)
    {
        try {
            $this->service->unpublish($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    
    
    
}

