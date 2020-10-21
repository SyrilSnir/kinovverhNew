<?php

use yii\helpers\VarDumper;

/**
 * Обертка для Yii2 VarDumper
 * @param mixed $var Отображаемая переменная
 * @param int $depth Максимальная глубина вложенности при выводе 
 * объекта или массива
 * @param bool $highlight Использовать стилевую подсветку (по умолчанию ДА)
 */
function dump($var,$depth = 15, $highlight = true) 
{
    VarDumper::dump($var,$depth,$highlight);
}

/**
 * Разбиение строки на массив символов (аналог str_split для многобайтных кодировок)
 * @param type $string
 * @return type
 */
 
if (!function_exists('mb_str_split')) {
    function mb_str_split( $string ) 
    { 
        return preg_split('/(?<!^)(?!$)/u', $string );
    }
}

if (!function_exists('mb_uppercase')) {
    function mb_uppercase(string $string):string
    {
        return mb_convert_case($string, MB_CASE_UPPER, "UTF-8");
    }
}

