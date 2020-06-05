<?php

namespace app\modules\adminka\assets;

use dmstr\web\AdminLteAsset;
use app\assets\YiiAsset;
/**
 * Description of LteAsset
 *
 * @author kotov
 */
class LteAsset extends AdminLteAsset
{
    public $depends = [
        YiiAsset::class
    ];
}
