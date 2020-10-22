<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\repositories\readModels;

use yii\data\DataProviderInterface;

/**
 *
 * @author kotov
 */
interface ReadModelInterface
{
    public function getAll(): DataProviderInterface;
}
