                <div class="form-group">
                    {{Form::label('username','Nombre de usuario')}}
                    {{Form::text('username', null, ['class'=>'form-control'] )}}
                    {{$errors->first('username', '<span class=text-danger>:message</span>')}}
               </div>

                <div class="form-group">
                    {{Form::label('email','Email')}}
                    {{Form::text('email', null, ['class'=>'form-control'] )}}
                    {{$errors->first('email', '<span class=text-danger>:message</span>')}}
                </div>

                <div class="form-group">
                    {{Form::label('nombre','Nombre')}}
                    {{Form::text('nombre', null, ['class'=>'form-control'] )}}
                    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
                </div>

                <div class="form-group">
                    {{Form::label('apepat','Apellido paterno')}}
                    {{Form::text('apepat', null, ['class'=>'form-control'] )}}
                    {{$errors->first('apepat', '<span class=text-danger>:message</span>')}}
                </div>

                <div class="form-group">
                    {{Form::label('apemat','Apellido materno')}}
                    {{Form::text('apemat', null, ['class'=>'form-control'] )}}
                    {{$errors->first('apemat', '<span class=text-danger>:message</span>')}}
                </div>


                <div class="form-group">
                    {{Form::label('password','Contraseña')}}
                    {{Form::password('password', ['class'=>'form-control'] )}}
                    {{$errors->first('password', '<span class=text-danger>:message</span>')}}
                </div>

                <div class="form-group">
                    {{Form::label('password_confirmation','Confirmar Contraseña')}}
                    {{Form::password('password_confirmation', ['class'=>'form-control'] )}}
                    {{$errors->first('password_confirmation', '<span class=text-danger>:message</span>')}}
                </div>

                <div class="form-group">
                    {{Form::label('password_confirmation','Rol')}}
                    {{Form::select('roles[]', Role::all(['id','name'])->lists('name', 'id'), $roles, ['class' => 'form-control', 'multiple'=>'multiple']) }}
                    {{$errors->first('roles[]', '<span class=text-danger>:message</span>')}}
                </div>

                @if (Session::get('error'))
                    <div class="alert alert-error alert-danger">
                        @if (is_array(Session::get('error')))
                            {{ head(Session::get('error')) }}
                        @endif
                    </div>
                @endif

                <div class="form-actions form-group">
                  {{ Form::submit('Guardar usuario', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
                </div>

