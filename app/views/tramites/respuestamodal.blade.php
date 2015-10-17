<html>
<head>
    <meta charset="UTF-8">
    <!-- JQuery -->
    {{ HTML::script('js/jquery/jquery.min.js') }}
</head>
<body>
<input type="hidden" id="resultado" value="{{$resultado}}"/>
<input type="hidden" id="mensaje" value="{{$mensaje}}"/>
<script>
    $(function () {

        var resultado = $('#resultado').val();
        var mensaje = $('#mensaje').val();
        var objResultado = {'resultado': resultado, 'mensaje': mensaje};
        console.log('LLega antes del mensaje');
        parent.top.postMessage('CACA','*');
        console.log('despues del mensaje',objResultado);

    });
</script>
</body>
</html>