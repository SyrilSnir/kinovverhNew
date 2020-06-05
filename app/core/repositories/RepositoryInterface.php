<?php

namespace app\core\repositories;

/**
 *
 * @author kotov
 */
interface RepositoryInterface
{
    /**
     * 
     * @param int $id
     * @return \app\core\repositories\ActiveRecordInterface|null
     */
    public static function findById($id);
    
    public function save($model);
}
