<?php

namespace app\commands\Controllers;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;


/**
 * Description of HelloController
 *
 * @author kotov
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo Yii::getAlias('@rbac') . "\n";

        return ExitCode::OK;
    }    
}
