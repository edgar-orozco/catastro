$(document).ready(function()
{


                 $('.enajenante-radio-persona').change(function (ev) {
                var radio = $(this);
                if (radio.val() == '1') {
                    var id = radio.data('tipo');
                    $("."+id).show();
                    $("#id_tipo").val('1');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');

                    //Habilitamos el autocomplete del curp
                     var curps = id+"[curp]";
                    $( "#" + curps.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");

                }
                else if (radio.val() == '2') {
                    var id = radio.data('tipo');
                    $("."+id).hide();
                    $("#id_tipo").val('2');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

                    //Habilitamos el autocomplete del curp
                    var curps = id+"[curp]";
                    $( "#" + curps.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
                }
            });




           $('.adquiriente-radio-persona').change(function (ev) {
                var radio = $(this);
                if (radio.val() == '1') {
                    var id = radio.data('tipo');
                    $("."+id).show();
                    $("#id_tipo").val('1');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');

                    //Habilitamos el autocomplete del curp
                     var curps = id+"[curp]";
                    $( "#" + curps.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");

                }
                else if (radio.val() == '2') {
                    var id = radio.data('tipo');
                    $("."+id).hide();
                    $("#id_tipo").val('2');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

                    //Habilitamos el autocomplete del curp
                    var curps = id+"[curp]";
                    $( "#" + curps.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
                }
    });
});
