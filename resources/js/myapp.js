$ = window.jQuery = require('jquery');

$(document).ready(function($){
    $('#ogrn-number').mask('0-00-00-00-00000-0');

    $("#ogrn-number").keyup(function(){
        if ($(this).val().length >17) {
            $(":submit").removeAttr("disabled");
            $("#textOk").removeAttr("hidden");
        } else {
            $(":submit").attr("disabled", true);
            $("#textOk").attr("hidden", true);
        }
    });

});

