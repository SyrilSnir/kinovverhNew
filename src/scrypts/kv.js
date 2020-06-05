/* Инициализирует глобальный объект приложения kv */
/* global $ */
/* global kv */
import Handlebars from 'handlebars/dist/cjs/handlebars'

class GlobalLoader {
    init() {
        this._initKvObject();
        this._initJQueryExtend();
    }
    _initJQueryExtend() {
        $.fn.displayMessage = function(retObject) {
            var obj = this;
            obj.find('.alert').remove();
            if (!Object.prototype.hasOwnProperty.call(retObject,'hasError')) {
                return obj;
            }  
            var tplVars = {},
                template,htmlData;
            if (retObject.hasError === true) {
                tplVars.error = 'Ошибка';
                tplVars.message = retObject.errorMessage;
                template = Handlebars.compile(kv.templates.alert);        
            } else {
                tplVars.message = retObject.data.message;
                template = Handlebars.compile(kv.templates.success);
            }
            htmlData = template(tplVars);
            obj.prepend(htmlData);
            return obj;        
        }
    }
    _initKvObject() {
        if (window.kv) {
            throw new Error('Global object "kv" already defined');
        }
        console.log('Инициализация глобального объъекта приложения')
        window.kv = {
            version : '0.0.0',
            author : 'Konstantin Kotov',
            templates: {
                alert : '<div class="alert alert-danger"><strong>{{error}}! </strong>' +
                        '{{message}}' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>' +
                        '</div>',
                success : '<div class="alert alert-success">{{message}}' +
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>' +
                          '</div>'
                }, 
            utils : {
                parseAjaxData : function(data) {
                    var retObject = {
                        hasError : false
                    }
                    try {                
                        let dataObj = JSON.parse(data);
                        if (Object.prototype.hasOwnProperty.call(dataObj,'errorCode')) {
                            retObject.errorCode = dataObj.errorCode;
                            retObject.errorMessage = dataObj.message;
                            retObject.hasError = true;
                        } else {
                            retObject.data = dataObj;
                        }
                    } catch (err) {
                        retObject.hasError = true;
                        retObject.errorCode = 0;
                        retObject.errorMessage = 'Неверный формат данных';
                        retObject.data = data;
                        console.log(retObject.errorMessage);
                        return retObject;
                    }

                        // console.log(retObject);
                        return retObject;        
                },
                renderTemplate(type,data) {
                    var template;
                    if (type === 'undefined') {
                        type = 'success';
                    }
                    switch (type) {
                        case 'error': 
                            template = this.templates.alert;
                            break;
                    }
                    return Handlebars.compile(template,data);
                }
            }       
        }
    }
}
export default GlobalLoader