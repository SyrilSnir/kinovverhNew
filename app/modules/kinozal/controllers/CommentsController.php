<?php

namespace app\modules\kinozal\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Forms\Comments\CommentForm;
use app\models\ActiveRecord\Film\FilmComment;
use Yii;

/**
 * Description of CommentsController
 *
 * @author kotov
 */
class CommentsController extends Controller
{
    /**
     *
     * @var CommentForm
     */
    protected $commentForm;
    
    public function __construct(
            $id, 
            $module, 
            CommentForm $form,
            $config = array()
            )
    {
        parent::__construct($id, $module, $config);
        $this->commentForm = $form;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'save-comment' => ['POST']
                ]
            ]
        ];
    }

    public function actionSaveComment()
    {
        if ($this->commentForm->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->isGuest) {
                $user = Yii::$app->user->getIdentity();
                if (empty($user->first_name)) {
                    $this->commentForm->userName = $user->login;
                } else {
                    $this->commentForm->userName = $user->first_name;
                }  
            }
            if ($this->commentForm->validate()) {
                $comment = FilmComment::create(
                        $this->commentForm->filmId,
                        $this->commentForm->userName, 
                        $this->commentForm->message
                        );
                $comment->save();
                Yii::$app->session->setFlash('comment_saved','Комментарий сохранен. Он будет показан после проверки модератором.');
            }
        }
        
        return $this->redirect('/kinozal/'.$this->commentForm->filmSlug .'/comments');
    }
}
