{{ HTML::style('/css/complementarios_cargar/fileinput.css') }}
<h3 class="header">{{$title}}</h3>
<hr>
{{ Form::model($row, ['route' => array('updateAvaluoFotos', $row->idavaluo), 'method'=>'put' ]) }}
<div class="row">
	<div class="col-md-12"><h3>Fotos</h3></div>
	<div class="col-md-12">
		{{Form::file('foto0', ['id'=>'foto0']) }}
	</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-12">&nbsp;</div>

</div>


{{Form::close()}}
@section('javascript')
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/fileinput.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
<script>
    $(document).ready(function () {
        $('#btn3FotoPlano').removeClass("btn-info").addClass("btn-primary");
        $.fn.fileinput.locales._LANG_ = {
            fileSingle: 'Archivo',
            filePlural: 'Archivos',
            browseLabel: 'Examinar &hellip;',
            removeLabel: 'Eliminar',
            removeTitle: 'Eliminar archivos seleccionados',
            cancelLabel: 'Cancelar',
            cancelTitle: 'Abort ongoing upload',
            uploadLabel: 'Subir',
            uploadTitle: 'Subir archivos seleccionados',
            msgSizeTooLarge: 'El archivo "{name}" (<b>{size} KB</b>) excede el peso permitido de carga <b>{maxSize} KB</b>. Vuelva a intentarlo!',
            msgFilesTooLess: 'You must select at least <b>{n}</b> {files} to upload. Please retry your upload!',
            msgFilesTooMany: 'Numero de archivos seleccionados <b>({n})</b> excede el limite de carga permitido de <b>{m}</b>. Vuelva a intentarlo!',
            msgFileNotFound: 'El archivo "{name}" no se encuentra!',
            msgFileSecured: 'Security restrictions prevent reading the file "{name}".',
            msgFileNotReadable: 'File "{name}" is not readable.',
            msgFilePreviewAborted: 'File preview aborted for "{name}".',
            msgFilePreviewError: 'An error occurred while reading the file "{name}".',
            msgInvalidFileType: 'Archivo invalido "{name}". Solo "{types}" se aceptan.',
            msgInvalidFileExtension: 'Extension invalida "{name}". Solo "{extensions}" se aceptan.',
            msgValidationError: 'Error al subir archivo',
            msgLoading: 'Loading file {index} of {files} &hellip;',
            msgProgress: 'Cargando archivo {index} de {files} - {name} - {percent}% completado.',
            msgSelected: '{n} files selected',
            msgFoldersNotAllowed: 'No se permite arrastrar carpetas {n} carpetas ignoradas(s).',
            dropZoneTitle: 'Suelta tus archivos aqui &hellip;'
        };

        $.extend($.fn.fileinput.defaults, $.fn.fileinput.locales._LANG_);
        $("#foto0").fileinput({
			overwriteInitial: false
        });
    });
</script>
@stop
