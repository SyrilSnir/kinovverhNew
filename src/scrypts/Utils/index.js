export function parseAjaxData(data) {
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
}