/* /Вывод сообхений */
class Alert {
    constructor(message) {
        this.message = message;
    }
    getErrorMessage(head) {
        return alertMessageTemplate(head,this.message);
    }
    getSuccessMessage() {
        return successMessageTemplate(this.message);
    }
}
const alertMessageTemplate = (head,message) => 
    `<div class="alert alert-danger"><strong>${head}!</strong>${message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button></div>`;
const successMessageTemplate = (message) => 
    `<div class="alert alert-success">${message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button></div>`;

export default Alert;