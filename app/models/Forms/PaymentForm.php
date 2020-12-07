<?php

namespace app\models\Forms;

use yii\base\Model;

/**
 * Description of PaymentForm
 *
 * @author kotov
 */
class PaymentForm extends Model
{
    public $summa;
    
    public function rules()
    {
        return [
            [['summa'],'required'],
            [['summa'],'integer'],
        ];
    }
    
    public function attributeLabels(): array
    {
        return [
            'summa' => 'Сумма'
        ];
    }
}
