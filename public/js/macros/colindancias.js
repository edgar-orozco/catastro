/**
 * Created by Marcela on 24/06/2015.
 */

$( ".agregarColindancia" ).click(function() {

    var $div = $('div[id^="colindanciaDiv"]:last');
    var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;

    var clon = $div.clone(true, true).prop('id', 'colindanciaDiv'+num );
    clon.find('select')[0].name = 'colindancia['+num+'][orientacion]';
    clon.find('input')[0].name = 'colindancia['+num+'][superficie]';
    clon.find('input')[1].name = 'colindancia['+num+'][colindancia]';

   $($div).after(clon);

});

$(".quitarColindancia").click(function() {
    var kids = $("#divsColindancias").children();
    var len = kids.length;
    if (len > 1) {
         var divBorrar = ($(this).parent().parent().attr('id'));
        $('#' + divBorrar).remove();
    }
});
