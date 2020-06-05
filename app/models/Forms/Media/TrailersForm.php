<?php

namespace app\models\Forms\Media;

use yii\base\Model;

/**
 * Description of TrailersForm
 *
 * @author kotov
 */
class TrailersForm extends Model
{
    public $id;
    /**
     * @var UploadedFile[]
     */
    public $files;  

    public function rules(): array
    {
        return [
            ['files', 'each', 'rule' => ['image']],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }
}
