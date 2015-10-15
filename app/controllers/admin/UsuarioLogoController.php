<?php


class admin_usuarioLogoController extends \BaseController
{
    /**
     * User Model
     * @var User
     */
    protected $user;


    /**
     * Inject the models.
     * @param User       $user
     * @param Role       $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->user = $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update($id, $format = 'html')
    {
        $user = User::find($id);
        if(Input::file('foto')) {
            // Se valida el directorio para subir shapes
            $dir = public_path('logos/usuarios');
            error_log($dir);
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }

            // Se valida la extensión del archivo
            if(in_array(strtolower(Input::file('foto')->getClientMimeType()), array('image/png', 'image/jpg', 'image/jpeg'))) {
                $fileName = $user->username.'.' . Input::file('foto')->getClientOriginalExtension();
                Input::file('foto')->move($dir, $fileName);
            }
            $user->foto = $fileName;
        }

        if ($user->save()) {
            if ($format == 'json') {
                return array(
                    'status' => 'success',
                    'msg' => 'Logo actualizado',
                    'data' => array(
                        'id'        => $user->id,
                    ),
                );
            }
            return Redirect::to('admin/user')->with('success', "Se han actualizado correctamente el logo del usuario ".$user->nombreCompleto());
        } else {
            // Get validation errors (see Ardent package)
            $error = $user->errors;
            if ($format == 'json') {
                return array(
                    'status' => 'error',
                    'msg' => 'Datos incorrectos',
                    'data' => array('errors' => $error)
                );
            }
            return Redirect::to('admin/user/'.$user->id.'/edit')->withInput()->withErrors($error);
        }
    }

}
