<?php

class RegistroController extends BaseController {

    protected $layout = 'layouts.default';
    public $Captcha;

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => 'getDashboard'));

        // Captcha parameters:
        $captchaConfig = array(
            'CaptchaId' => 'AuthCaptcha', // a unique Id for the Captcha instance
            'UserInputId' => 'CaptchaCode' // Id of the Captcha code input textbox
        );
        $this->Captcha = BotDetectCaptcha\LaravelCaptcha\BotDetectLaravelCaptcha::GetCaptchaInstance($captchaConfig);
    }

    /**
     * Muestra la pantalla registro.
     * @return \Illuminate\View\View
     */
    public function index() {

        $title = 'Registro';

        //Título de sección:
        $title_section = "Registro";

        //Subtítulo de sección:
        $subtitle_section = "Registro de usuarios virtuales.";
//        $this->layout->content = View::make('registro.primera-atencion')
//                ->with('captchaHtml', $this->Captcha->Html());

        return View::make('registro.primera-atencion', compact('title', 'title_section', 'subtitle_section', 'tipotramites', 'municipios'))->with('captchaHtml', $this->Captcha->Html());
    }

    public function getRegister() {
        // make register view passsing Captcha Html accessible to View code
        $this->layout->content = View::make('registro.primera-atencion')
                ->with('captchaHtml', $this->Captcha->Html());
    }

    public function getDashboard() {
        $this->layout->content = View::make('registro.dashboard');
    }

    public function postAdd() {
        // validate the user-entered Captcha code on form submit
        $code = Input::get('CaptchaCode');
        $isHuman = $this->Captcha->Validate($code);

        $rules = array(
            'name' => array('required', 'alpha', 'min:5'),
            'email' => array('required', 'email', 'unique:users'),
            'password' => array('required', 'between:6,30', 'confirmed'),
            'password_confirmation' => array('required', 'between:6,30')
        );

        $validator = Validator::make(Input::all(), $rules);

        $captchaValidationStatus = '';
        $message = '';
        $isSuccess = true;

        if ($isHuman && !$validator->fails()) {

            // Captcha validation success; Saving the new user

            $user = new User;
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            $this->Captcha->Reset();

            $message = 'Thank you. You have successfully registerd.';
        } else {
            if (!$isHuman) {
                // Captcha validation failed, return an error message
                $captchaValidationStatus = 'CAPTCHA validation failed, please try again.';
            } else {
                $message = 'An error occurred while registering.';
            }
            $isSuccess = false;
        }

        return Redirect::to('registro/primera-atencion')
                        ->withInput()
                        ->withErrors($validator)
                        ->with('captchaValidationStatus', $captchaValidationStatus)
                        ->with('message', $message)
                        ->with('isSuccess', $isSuccess);
    }

    public function postSignin() {
        // validate the user-entered Captcha code when the form is submitted
        $code = Input::get('CaptchaCode');
        $isHuman = $this->Captcha->Validate($code);

        $rememberMe = (Input::get('remember_me') == 'on') ? true : false;

        if ($isHuman && Auth::attempt(array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password')), $rememberMe)) {
            // Captcha validation passed and login successful
            $this->Captcha->Reset();
            return Redirect::to('registro/dashboard');
        } else {
            if (!$isHuman) {
                // Captcha validation failed, return an error message
                $message = 'CAPTCHA validation failed, please try again.';
            } else {
                $message = 'The email or password you entered is incorrect, 
            please try again.
          ';
            }
            return Redirect::to('registro/primera-atencion')
                            ->with('message', $message);
        }
    }

}
