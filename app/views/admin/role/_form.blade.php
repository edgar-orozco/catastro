<div class="form-group">
    {{Form::label('name','Rol')}}
    {{Form::text('name', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('name', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    <select  class="select2-select" multiple="multiple" name="permissions[]" data-permission="[ {{ implode(',', $role->perms->lists('id'))  }} ]" >
        @foreach($permissions as $permission)
            <option value="{{ $permission->id }}"> {{ $permission->display_name }} </option>
        @endforeach
    </select>
</div>