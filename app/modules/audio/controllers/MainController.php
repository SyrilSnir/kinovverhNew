<?php

namespace app\modules\audio\controllers;

use app\core\repositories\readModels\Audio\AlbumReadRepository;
use yii\web\Controller;
/**
 * Description of IndexController
 *
 * @author kotov
 */
class MainController extends Controller
{
    /**
     *
     * @var AlbumReadRepository
     */
    private $albums;

    public function __construct(
            $id, 
            $module, 
            AlbumReadRepository $albums,
            $config = array()
            )
    {
        parent::__construct($id, $module, $config);
        $this->albums = $albums;
    }
    public function actionIndex() 
    {
        $albumsProvider = $this->albums->getAll();
        return $this->render('index',[
            'albums' => $albumsProvider
        ]);
    }
}
