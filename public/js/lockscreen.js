// Variable para el tiempo sin actividad
var idleTime    = 0,
    sessionTime = 0,
    session     = 0;
$(document).ready(function () {
    // Se obtiene el valor del tiempo de sesión
    // y se coloca el intervalo que revisa si la sesión continua abierta
    $.ajax({
        url: '/lock-screen',
        context: document.body
    }).done(function(data) {
        session = data.session;
        //Se inicia el intervalo
        starIntervalLock();
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
                    // Se reinicia el tiempo de sesion
                    sessionTime = 0;
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
function starIntervalLock(){
    var idleInterval = setInterval(function() {
        // Se suma un minuto al tiempo de sesión
        sessionTime = sessionTime + 1;
        // Se revisa el tiempo de sesión, si es mayor a tres cuartas partes del tiempo de la sesión
        // Se extiende en automático el tiempo de vida, siempre que el contador de abandono sea 0
        if(sessionTime >= ( (session * 3) / 4 ) && idleTime == 0 ){
            // Se hace un keep alive para extender la sesión sin que el usuario intervenga
            $.ajax({
                url: '/lock-screen',
                context: document.body
            }).done(function(data) {
                session = data.session;
                sessionTime = 0;
            });
        }
        // Se suma un minuto al tiempo de abandono
        idleTime = idleTime + 1;
        // Se revisa el tiempo de abandono
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