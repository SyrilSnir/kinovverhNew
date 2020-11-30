import {parseAjaxData} from './../Utils';
import Alert from './../Components/Alert';

let $ = window.$; // global jQuery
class LkDispatcher {
    constructor(containerClass) {
        this.$container = $(containerClass);
        $(".lk-form .input-group-addon").on("click",".glyphicon-pencil",    
            this._editData.bind(this)
        );
        $(".lk-form .input-group-addon").on("click",".glyphicon-ok",
            this._saveData.bind(this)
        );  
        $(".lk-form .input-group-addon").on("click",".glyphicon-remove-sign",
            this._cancel.bind(this)
        );
        $('.lk-menu-item a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $('#pop-favorite-remove').on('shown.bs.modal', function (e) {
            $(e.relatedTarget).parents('.pop-film').fadeOut().remove();
        });        
    }
    _editData(e) {
        let $target = $(e.currentTarget);
        $target.removeClass('glyphicon-pencil').addClass('glyphicon-ok').attr('title','Сохранить').after("<i class='glyphicon glyphicon-remove-sign' title='Отменить''></i>");
        $target.parents(".input-group").find("input").removeAttr('disabled').focus(); 
    }
    _saveData(e) {
        let $target = $(e.currentTarget),
            $currentInput = $target.parents('.input-group').find('input'),
            currentName = $currentInput.attr('name');
        $.post('/lk/save',{
                'name' : currentName,
                'value' :  $currentInput.val() 
            }).then((result) => {
                let resObject = parseAjaxData(result),
                    htmlData = '';
                if (resObject.hasError) {
                    let messageResolver = new Alert(resObject.errorMessage);
                    htmlData = messageResolver.getErrorMessage('Ошибка');
                } else { 
                    let messageResolver = new Alert(resObject.data.message);                    
                    htmlData = messageResolver.getSuccessMessage();                    
                }                 
                this.$container.find('.alert').remove();
                this.$container.prepend(htmlData);                
            });
    }
    _cancel(e) {
        let $target = $(e.currentTarget),
            cIn = $target.parents(".input-group").children('input');
        cIn.val(cIn.data("default"));
        cIn.attr("disabled",'disabled');
        $target.siblings('i').remove();
        $target.removeClass('glyphicon-remove-sign').addClass('glyphicon-pencil').attr("title","Редактировать");
    }
}
export default LkDispatcher;