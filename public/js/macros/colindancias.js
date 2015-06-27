/**
 * Created by Marcela on 24/06/2015.
 */


$( ".agregarColindancia" ).click(function() {

    var $div = $('div[id^="colindanciasDiv"]:last');
    var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;

    var clon = $div.clone(true, true).prop('id', 'colindanciasDiv'+num );
    $($div).after(clon);

});

$(".quitarColindancia").click(function() {
    var divBorrar = ($(this).parent().parent().attr('id'));
    $('#'+divBorrar).remove();
});
