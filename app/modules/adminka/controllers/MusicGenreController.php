<?php

namespace app\modules\adminka\controllers;

use app\core\services\operations\Audio\GenreService;
use app\core\repositories\Audio\GenreRepository;
use app\models\SearchModels\Audio\GenreSearch;
use app\models\Forms\Manage\Audio\GenreForm;
use Yii;
/**
 * Description of MusicGenreController
 *
 * @author kotov
 */
class MusicGenreController extends BaseAdminController
{
            /**
     *
     * @var GenreService
     */
    protected $service;
    /**
     *
     * @var GenreRepository
     */
    protected $repository;
    
    public function __construct(
        $id, 
        $module, 
        GenreRepository $repository,
        GenreService $service,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }
    
    public function actionIndex()
    {
        $searchModel = new GenreSearch();
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
            'genre' => $this->findModel($this->repository,$id),
        ]);
    }
    
    public function actionCreate()
    {
        $form = new GenreForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $genre = $this->service->create($form);
                return $this->redirect(['view', 'id' => $genre->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }
    
}
