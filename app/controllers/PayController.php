<?php

namespace app\controllers;

use app\core\manage\auth\UserIdentity;
use app\models\Forms\PaymentForm;
use robokassa\Merchant;
use Yii;

/**
 * Description of PayController
 *
 * @author kotov
 */
class PayController extends AuthorithedController
{
    public function actionIndex()
    {
        /** @var Merchant $merchant */
        /** @var UserIdentity $user */
        $paymentForm = new PaymentForm();
        $user = Yii::$app->user->getIdentity();
        $merchant = Yii::$app->get('robokassa');
        $paymentForm->load(Yii::$app->request->post());
        if ($paymentForm->validate()) {
            return $merchant->payment($paymentForm->summa, $user->getId());
         //   return $paymentForm->summa;
        }
    }
}
