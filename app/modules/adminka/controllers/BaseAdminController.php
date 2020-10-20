<?php

namespace app\modules\adminka\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\core\repositories\RepositoryInterface;
use yii\web\NotFoundHttpException;
use yii\db\ActiveRecord;

/**
 * Description of BaseAdminController
 *
 * @author kotov
 */
abstract class BaseAdminController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['adminPanel'],
                    ],
                ]
            ]
        ];
    }
    
    /**
     * @param integer $id
     * @return ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(RepositoryInterface $repository, $id): ActiveRecord
    {
        if (($model = $repository->findById($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }    
}
