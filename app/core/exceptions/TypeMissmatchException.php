<?php

namespace app\core\exceptions;

/**
 * Description of TypeMissmatchException
 *
 * @author kotov
 */
class TypeMissmatchException extends \Exception
{
    public function __construct($message = "Не соответсвие типов передаваемых данных", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
