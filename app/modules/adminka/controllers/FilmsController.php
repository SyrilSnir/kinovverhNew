<?php

namespace app\modules\adminka\controllers;

use app\core\repositories\Films\FilmRepository;
use app\core\services\operations\Kinozal\FilmService;
use app\models\SearchModels\Films\FilmSearch;
use app\models\Forms\Manage\Films\FilmCreateForm;
use app\models\Forms\Manage\Films\FilmEditForm;

use app\core\helpers\ReadModels\PersonHelper;
use Yii;
/**
 * Description of FilmsController
 *
 * @author kotov
 */
class FilmsController extends BaseAdminController
{
       /**
     *
     * @var FilmService
     */
    protected $service;    
    /**
     *
     * @var FilmRepository
     */
    protected $repository;
    
    public function __construct(
            $id, 
            $module, 
            FilmRepository $repository,
            FilmService $service,
            $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    } 
    
    public function actionIndex() 
    {
        $searchModel = new FilmSearch();
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
            'film' => $this->findModel($this->repository,$id),
        ]);
    }
    
    public function actionCreate()
    {
        $form = new FilmCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $film = $this->service->create($form);
                return $this->redirect(['view', 'id' => $film->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
            'personList' => PersonHelper::getPersonList()
        ]);
    }

    public function actionUpdate($id) 
    {
        $film = $this->findModel($this->repository, $id);
        $galleryImageList = $film->gallery;
        $trailersVideoList = $film->trailers;
        $form = new FilmEditForm($film);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($film->id, $form);
                return $this->redirect(['view', 'id' => $film->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'filmId' => $id,
            'galleryImageList' => $galleryImageList,
            'trailersVideoList' => $trailersVideoList,
            'personList' => PersonHelper::getPersonList()
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
