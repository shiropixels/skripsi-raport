//I will make sure this code run on Script Load
$(document).ready(function(){
    $('.numeric-text').keypress(function(evt){
        if (evt.which < 48 || evt.which > 57){
            evt.preventDefault();
        }
    });

});