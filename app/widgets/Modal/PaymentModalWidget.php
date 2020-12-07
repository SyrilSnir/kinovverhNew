<?php

namespace app\widgets\Modal;

use app\models\Forms\PaymentForm;
use yii\base\Widget;

/**
 * Description of PaymentModalWidget
 *
 * @author kotov
 */
class PaymentModalWidget extends Widget
{
    public function run()
    {
        $model = new PaymentForm();
        return $this->render('pay-err',[
          'model' => $model  
        ]);
    }
}
