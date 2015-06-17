<?php



/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends Controller
{
    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function getLogin()
    {
        if (Confide::user()) {
            return Redirect::to('/');
        } else {
            return View::make(Config::get('confide::login_form'));
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function postLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            return Redirect::intended('/');
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } elseif (!$repo->isActive($input)) {
                $err_msg = 'El permiso de acceso de este usuario ya no es vigente';
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UsersController@getLogin')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Login mediante la pantalla de lockscreen
     *
     * @return  Illuminate\Http\Response
     */
    public function postLoginLock()
    {
        // Se crea un validador del formulario
        $validator = Validator::make(Input::all(), array(
            'username' => 'required',
            'password' => 'required'
        ));
        // Se valida que se reciban los datos necesarios
        if ($validator->fails()) {
            // Si no se enviaron los datos correctos se regresa el error en JSON
            return Response::json(array(
                'message' => 'Datos incorrectos',
                'errors' => $validator->messages(),
                'statusCode' => 400,
            ));
        } else {
            // Se realizan las validaciones
            $user = array(
                'username'  => Input::get('username'),
                'password'  => Input::get('password'),
            );
            $userdata = User::where('username', Input::get('username'))->first();
            // Se valida que exista el usuario ingresado
            if (empty($userdata)) {
                return Response::json(array(
                    'message' => 'El usuario no existe',
                    'errors' => '',
                    'statusCode' => 401,
                ));
            }
            if (Auth::attempt($user, false)) {
                // Se habilita la sesión nuevamente si los datos del usuario con correctos
                Session::put('user_id', Auth::user()->id);
                return Response::json(array(
                    'message' => 'autenticado',
                    'errors' => '',
                    'statusCode' => 200,
                ), 200);
            } else {
                // Si los datos no son correctos se envía un mensaje de error
                return Response::json(array(
                    'message' => 'El password es incorrecto intenta nuevamente',
                    'errors' => '',
                    'statusCode' => 401,
                ));
            }
            // Si no se obtiene ninguna respuesta se envía un error desconocido
            return Response::json(array(
                'message' => 'No fue posible iniciar sesicón, intenta nuevamente',
                'errors' => '',
                'statusCode' => 402,
            ));
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function getConfirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@getLogin')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@getLogin')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function getForgot()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function postForgot()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UsersController@getLogin')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UsersController@postForgot')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function getReset($token)
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function postReset()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@getLogin')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UsersController@getReset', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function getLogout()
    {
        Confide::logout();
        //Eliminamos todos los posibles valores temporales que guardamos en la sesion
        Session::flush();
        return Redirect::to('/');
    }
}
