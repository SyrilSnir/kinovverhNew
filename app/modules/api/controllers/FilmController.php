<?php

namespace app\modules\api\controllers;

use app\core\services\operations\Kinozal\FilmService;
use Yii;

/**
 * Description of FilmController
 *
 * @author kotov
 */
class FilmController extends BaseApi
{
    /**
     *
     * @var FilmService
     */
    private $filmService;
    
    public function __construct(
            $id, 
            $module, 
            FilmService $filmService,
            $config = []
            )
    {
        parent::__construct($id, $module, $config);
        $this->filmService = $filmService;
    }

    
    public function actionToFavorite() 
    {
        $successMessage = 'Фильм добавлен в раздел «Избранное» в <a href="/lk#favorites">личном кабинете</a>';
        $filmId = (int) Yii::$app->request->post('filmId');
        $userId = Yii::$app->user->getId();
        if (!empty($filmId)) {
            $this->filmService->toFavorites($filmId, $userId);
            return [
              'message' =>  $successMessage
            ];
        }
        return [
            'message' => 'Операция закончилась неудачей'
        ];
    }
    
    public function actionRemoveFromFavorites()
    {
        $successMessage = 'Фильм был успешно удален из раздела «Избранное» в <a href="/lk#favorites">личном кабинете</a>';
        $filmId = (int) Yii::$app->request->post('filmId');
        $userId = Yii::$app->user->getId();  
        if (!empty($filmId)) {
            $this->filmService->removeFromFavorites($filmId, $userId);
            return [
              'message' =>  $successMessage
            ];
        }
        return [
            'message' => 'Операция закончилась неудачей'
        ];       
    }
}
