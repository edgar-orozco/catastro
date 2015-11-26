/**
 * Created by Marcela on 24/06/2015.
 */




$(document).on('click','.agregarPersonaFisica',function () {

    var $div = $('div[id^="personaDiv"]:last');
    var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;


    var clon = $div.clone(true, true).prop('id', 'personaDiv' + num);

    var curp = clon.find('input')[0];
    var curp2 = clon.find('input')[0];
    var rfc = clon.find('input')[1];
    var nombres = clon.find('input')[2];
    var apellido_paterno = clon.find('input')[3];
    var apellido_materno = clon.find('input')[4];

    //Etiquetas de nombres
    var label = clon.find('label')[0];
    var label2 = clon.find('label')[1];
    var label3 = clon.find('label')[2];
    var label4 = clon.find('label')[3];
    var label5 = clon.find('label')[4];


    //modificamos el nombre

    curp.name = curp.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
    //    curp2.id = curp2.id.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");

     rfc.name = rfc.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
      nombres.name = nombres.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
       apellido_paterno.name = apellido_paterno.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
        apellido_materno.name = apellido_materno.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");


    //los creamos en blanco
    $(curp).val('').show().removeData();
    $(rfc).val('');
    $(nombres).val('');
    $(apellido_paterno).val('').show();
    $(apellido_materno).val('').show();

    //Mostramos etiquetas ocultas
    $(label).show();
    $(label4).show();
    $(label5).show();


    $($div).after(clon);

});

$(document).on('click','.agregarPersonaMoral',function () {

    var $div = $('div[id^="personaDiv"]:last');
    var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;


    var clon = $div.clone(true, true).prop('id', 'personaDiv' + num);

    var curp = clon.find('input')[0];
    var rfc = clon.find('input')[1];
    var nombres = clon.find('input')[2];
    var apellido_paterno = clon.find('input')[3];
    var apellido_materno = clon.find('input')[4];

    var label = clon.find('label')[0];
    var label2 = clon.find('label')[1];
    var label3 = clon.find('label')[2];
    var label4 = clon.find('label')[3];
    var label5 = clon.find('label')[4];

    //modificamos el nombre

    //curp.name = curp.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
     rfc.name = rfc.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
      nombres.name = nombres.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
       //apellido_paterno.name = apellido_paterno.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
        //apellido_materno.name = apellido_materno.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");


    //los creamos en blanco
    $(curp).hide();
    $(rfc).val('');
    $(nombres).val('');
    $(apellido_paterno).hide();
    $(apellido_materno).hide();

    $(label).hide();
    $(label4).hide();
    $(label5).hide();


    $($div).after(clon);

});



$(document).on('click','.quitarPersona',function () {
    var confirma = confirm('¿Está seguro que desea borrar la Persona?');
    if (confirma == true) {
        var kids = $("#personaDiv").children();
        var len = kids.length;

        if (len > 1) {
            var divBorrar = ($(this).parent().parent().parent().attr('id'));
            $('#' + divBorrar).remove();
        }
        else {

            $(this).parent().parent().find('select').val(null);
        }
    }
});



