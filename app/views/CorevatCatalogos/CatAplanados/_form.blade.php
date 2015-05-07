<div class="form-group">
	{{Form::label('aplanado','Descripción')}}
	{{Form::text('aplanado', null, ['Placeholder'=>'Descripción','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatAplanados.aplanado', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)', 'maxlength'=>'100'] )}}
	{{$errors->first('aplanado', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status', 'Estatus')}}
	{{ Form::checkbox('status', 1,  $row->status) }}
</div>
@section('javascript')
<script>
	function aMayusculas(obj, id) {
		obj = obj.toUpperCase();
		document.getElementById(id).value = obj;
	}
	//Mensaje para eliminar
	$("body").delegate('.eliminar', 'click', function () {
		if (!confirm("¿Seguro que quiere eliminar el registro?")) {
			return false;
		}
	});
    // Al presionar cualquier tecla en cualquier campo de texto, ejectuamos la siguiente función
	$('input').on('keydown', function (e) {
		// Solo nos importa si la tecla presionada fue ENTER... (Para ver el código de otras teclas: http://www.webonweboff.com/tips/js/event_key_codes.aspx)
		if (e.keyCode === 13)
		{
			// Obtenemos el número del tabindex del campo actual
			var currentTabIndex = $(this).attr('tabindex');
			// Le sumamos 1 :P
			var nextTabIndex = parseInt(currentTabIndex) + 1;
			// Obtenemos (si existe) el siguiente elemento usando la variable nextTabIndex
			var nextField = $('[tabindex=' + nextTabIndex + ']');
			// Si se encontró un elemento:
			if (nextField.length > 0)
			{
				// Hacerle focus / seleccionarlo
				nextField.focus();
				// Ignorar el funcionamiento predeterminado (enviar el formulario)
				e.preventDefault();
			}
			// Si no se encontro ningún elemento, no hacemos nada (se envia el formulario)
		}
	});
</script>
@append
