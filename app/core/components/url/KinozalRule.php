<?php

namespace app\core\components\url;

use yii\web\UrlRuleInterface;
use yii\web\Request;
use app\core\tools\Url;
use app\core\repositories\Films\FilmRepository;
use Yii;


/**
 * Description of KinozalRule
 *
 * @author kotov
 */
class KinozalRule implements UrlRuleInterface
{
    protected $prefix = 'kinozal';
    protected $noneFilmCode = [
                'comments',
                'categories',
                'znak',
                'view'
            ];
    
    public function createUrl($manager, $route, $params)
    {
        $url = $route;
        foreach ($params as $name => $value) {
            $url .= "/{$name}/{$value}";
        }
        return $url;
    }
    /**
     * 
     * @param UrlManager $manager
     * @param Request $request
     */
    public function parseRequest($manager, $request)
    {
        if(Url::getValFromURI(0,$request->pathInfo) != $this->prefix) {
            return false;
        } 
        $filmCode = Url::getValFromURI(1,$request->pathInfo);
               $filmRepository = new FilmRepository();
        if (empty($filmCode) || in_array($filmCode, $this->noneFilmCode)) {
            return false;
        }
       $film = $filmRepository->getFilmByCode($filmCode);
       Yii::$app->view->params['findedElement'] = $film;
            $params = ['slug' => $film->code];
        $action = Url::getValFromURI(2,$request->pathInfo);
        $route = 'kinozal/view';
        if (!empty($action) ) {
            $route .= '/' . $action;
        }
        return [$route,$params];
    }

}
