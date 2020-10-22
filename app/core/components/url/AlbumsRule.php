<?php

namespace app\core\components\url;

use app\core\repositories\Audio\AlbumRepository;
use app\core\tools\Url;
use Yii;
use yii\web\Request;
use yii\web\UrlManager;
use yii\web\UrlRuleInterface;

/**
 * Description of AlbumsRule
 *
 * @author kotov
 */
class AlbumsRule implements UrlRuleInterface
{
    protected $prefix = 'albums';
    
    protected $noneAlbumCode = [
                'listen'
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
       // if(Url::getValFromURI(0,$request->pathInfo) != 'albums') {
            return false;
        } 
        $albumCode = Url::getValFromURI(1,$request->pathInfo);
        $albumRepository = new AlbumRepository();
        if (empty($albumCode) || in_array($albumCode, $this->noneAlbumCode)) {
            return false;
        }
       $album = $albumRepository->getAlbumByCode($albumCode);
       Yii::$app->view->params['findedElement'] = $album;
        $params = ['slug' => $album->code];
        $action = Url::getValFromURI(2,$request->pathInfo);
        $route = 'audio/listen';
        if (!empty($action) && $action != 'listen' ) {
            $route .= '/' . $action;
        }
        return [$route,$params];
    }
}
