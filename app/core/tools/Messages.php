<?php

namespace app\core\tools;

/**
 * Менеджер сообщений
 *
 * @author kotov
 */
class Messages
{
    /**
     * 
     * @param type $message Текст сообщения
     * @param type $code Код ошибки 
     * @param type $json формат вывода
     * @return array|string массив или объект Json
     */
    public static function getErrorMessage($message,$code=0,$json=true) {
        $error = [
                    'errorCode' => $code,
                    'message' => $message
                ];
        if ($json) {
            return json_encode($error);
        }
        return $error;
    }
    /**
     * 
     * @param type $messageText Текст сообщения
     * @param type $json формат вывода
     * @return array|string массив или объект Json
     */
    public static function getMessage($messageText,$json=true) {
        $message = [
            'message' => $messageText
        ];
        if ($json) {
            return json_encode($message);
        }
        return $message;        
    } 
}
