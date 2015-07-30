
$(document).ready(function () {
$( "#formRegistro" ).validate({

});

$('.numeros').each(function() {
        $(this).rules('add', {
            required: true,
            number: true
           
        });
    });

$('.clave_cata').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 22,
            maxlength: 22
           
        });
    });

$('.requerido').each(function() {
        $(this).rules('add', {
            required: true
           
        });
    });


});