let $ = window.$; // global jQuery
class ShowCaption {
    constructor() {
        $('.pop-film')
        .on("mouseenter", function(e){
                e.preventDefault();
                $(this).find(".pop-film__data").addClass('pop-film__data--hover');
         })
        .on("mouseleave", function(e){
                e.preventDefault();
                $(this).find(".pop-film__data").removeClass('pop-film__data--hover');
         });
    }
}
export default ShowCaption;