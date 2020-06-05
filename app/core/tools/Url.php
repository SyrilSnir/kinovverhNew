<?php

namespace app\core\tools;

/**
 * Description of Url
 *
 * @author kotov
 */
class Url
{
      /**
  * Вернуть полную строку URI
  * @return string
  */
    public static function getUri($external = '')
    {
        if (!empty($external)) {            
            return (string) $external;
        }
        if (isset($_SERVER['HTTP_X_REWRITE_URL'])) 
        {
            $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
        }
        return $_SERVER['REQUEST_URI'];        
    }
    /**
     * 
     * @param string $external
     */
    public static function getHostUrl($external = '') {
        if ($external) {
            if (Validate::HttpProtocolExist($external)) {
                $url = $external;
            } else {
                $url = Http::getCurrentUrlProtocolPrefix() . $external;
            }
        } else {
        $url = Uri::getUri();
        }
        return parse_url($url,PHP_URL_HOST);
    }

    /**
    *  Вернуть очищенное от параметров значение URI
    * @return string
    */
    public static function getFilteredUrl($external = '')
    {
        $ret = self::getUri($external);
        $position = strpos($ret,'?');
        return  $position ? substr($ret,0,$position) : $ret;    
    }
    
    /**
     * Вернуть строку GET запроса
     * @return string
     */
    public static function getRequestParamsFromUri($external = '')
    {
        $ret = self::getUri($external);
        $position = strpos($ret,'?');
        return $position ? substr($ret,$position, strlen($ret)) : '';
    }
    /**
 * Возвращает значение строки пути (относительно хоста)
 * @param int $num индекс вложенности 
 * @return string protocol
 */
    public static function getValFromURI($num=0,$external = '')
    {
        $ret = self::getFilteredUrl($external);
        $path_array = explode("/", trim ($ret,"/"));
        if (count ($path_array)-1 < $num) {
            return '';
        } 
        return $path_array[$num] ;        
    } 
}
