<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgets\Modal;

use yii\base\Widget;

/**
 * Description of BaseModal
 *
 * @author kotov
 */
class BaseModal extends Widget
{
    protected $filmId;
    protected $modalId;
    protected $apiMethod;
    protected $oppositeButtonClass;


    public function init()
    {
        $this->registerScripts();
    }
    
    public function run()
    {
        return $this->render('favorite_modal',[
            'modalId' => $this->modalId
        ]);
    }
    
    private function registerScripts()
    {
        $script = <<<JS
            $('#$this->modalId').on('show.bs.modal', function (e) {
                console.log('load favorites widget');
                var targetButton = $(e.relatedTarget);
                var filmId = targetButton.data('id');
                console.log(filmId);
                $.ajax ({ 
                    url: '/api/film/$this->apiMethod',
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        'filmId' : filmId,
                    },
                    success: function(response) {
                        $('#$this->modalId .favorite-content').html(response.message);
                        targetButton.addClass('hide');
                        targetButton.siblings('.$this->oppositeButtonClass').removeClass('hide');
                    }
                });
            });
            
JS;                
        $this->view->registerJs($script, \yii\web\View::POS_READY);
    }
}
