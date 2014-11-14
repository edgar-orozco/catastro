<div class="form-group">
    {{Form::label('name','Rol')}}
    {{Form::text('name', null, ['class'=>'form-control'] )}}
    {{$errors->first('name', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
@foreach($permissions as $permission)
    {{Form::checkbox('permissions['.$permission->id.']', $permission->id, in_array($permission->id, $role->perms->lists('id')), ['id' => 'permissions['.$permission->id.']' ])}}
    {{Form::label('permissions['.$permission->id.']', $permission->display_name)}}
    <br>
@endforeach
</div>