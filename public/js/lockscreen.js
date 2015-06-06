// Variable para el tiempo sin actividad
var idleTime = 0;
$(document).ready(function () {
    var session = 0;
    // Se obtiene el valor del tiempo de sesión
    // y se coloca el intervalo que revisa si la sesión continua abierta
    $.ajax({
        url: '/lock-screen',
        context: document.body
    }).done(function(data) {
        session = data.session;
        //Se inicia el intervalo
        starIntervalLock(session);
        // Se resetea el valor del tiempo sin actividad cuando se presiona una tecla
        // o se mueve el cursor.
        $(this).mousemove(function (e) {
            idleTime = 0;
        });
        $(this).keypress(function (e) {
            idleTime = 0;
        });
    });

    // Se escucha el evento submit del formulario para enviar por
    // ajax los datos de autencicación
    $('#lock-screen-form').on('submit', function(){
        $('#lock-screen-error').hide();
        $.ajax({
            url: "/users/login-lock",
            method: "post",
            data:{
                username: $('#lock-username').val(),
                password: $('#lock-password').val()
            },
            beforeSend: function() {
                $('#lock-screen-loader').show();
                $('#lock-screen-submit').hide();
            },
            success: function( response ){
                $('#lock-screen-loader').hide();
                $('#lock-screen-submit').show();
                // Si el código es 200 se quita la pantalla de lock
                // y se activa nuevamente el intervalo
                if( response.statusCode == 200 ){
                    $('#lock-screen').hide('puff');
                    window.onbeforeunload = null;
                    starIntervalLock(session);
                    $('#lock-password').val('')
                } else {
                     // De lo contrario se muestra el mensaje de error
                    $('#lock-screen-error').show();
                    $('#lock-screen-error-text').html(response.message);
                }


            }
        });

        return false;
    });

});
/**
 * Función para iniciar el intervalo que bloquea la sesiñon
 * @param session
 */
function starIntervalLock(session){
    idleInterval = setInterval(function() {
        idleTime = idleTime + 1;
        if (idleTime >= session) {
            // Se muestra la pantalla de lock screen
            $('#lock-screen').show('puff');
            // Se agrega una alerta si se trata de refrescar la pantalla o dar back
            if(window.onbeforeunload === null){
                window.onbeforeunload = function() {
                    return "Si sales ahora perderás lo datos de tu sesión, ¿estás seguro de querer abandonar esta página?";
                };
            }
            // Se limpia el intervalo
            clearInterval(idleInterval);
        }
    }, 60000); // Se ejecuta cada minuto el intervalo
}