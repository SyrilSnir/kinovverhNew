<?php

namespace app\widgets\Auth;

use yii\base\Widget;
use app\models\Forms\User\RegisterForm;
/**
 * Description of RegisterFormWidget
 *
 * @author kotov
 */
class RegisterFormWidget extends Widget
{
    /**
     *
     * @var RegisterForm
     */
    public $model;
    
    public function init() {
        parent::init();
        if(empty($this->model)) {
            $this->model = new RegisterForm();
        }
    }

        public function run() {

        return $this->render('register_form', [
            'model' => $this->model,
        ]);
    }
    
}
