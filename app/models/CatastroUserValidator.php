<?php

use Illuminate\Support\Facades\App as App;
use Illuminate\Support\Facades\Lang as Lang;
use Illuminate\Support\MessageBag;
use Zizaco\Confide\UserValidatorInterface;
use Zizaco\Confide\ConfideUserInterface;
/**
 * Implementa validación de usuarios de catastro
 * @see \Zizaco\Confide\UserValidator
 */
class CatastroUserValidator implements UserValidatorInterface
{
    /**
     * Confide repository instance.
     *
     * @var \Zizaco\Confide\RepositoryInterface
     */
    public $repo;

    /**
     * Validation rules for this Validator.
     *
     * @var array
     */
    public $rules = [
        'create' => [
            'username' => 'required|alpha_num_dot',
            'email'    => 'email',
            'nombre'   => 'required|alpha_spaces', //Alfa mas espacios y unicode, para aceptar ñs y acentos
            'apepat'   => 'required|alpha_spaces',//Alfa mas espacios y unicode, para aceptar ñs y acentos
            'apemat'   => 'alpha_spaces',//Alfa mas espacios y unicode, para aceptar ñs y acentos
            'password' => 'required|min:6',
            'password_confirmation' => 'between:6,11',
        ],
        'update' => [
            'username' => 'required|alpha_num_dot',
            'email'    => 'email',
            'nombre'   => 'required|alpha_spaces', //Alfa mas espacios y unicode, para aceptar ñs y acentos
            'apepat'   => 'required|alpha_spaces',//Alfa mas espacios y unicode, para aceptar ñs y acentos
            'apemat'   => 'alpha_spaces',//Alfa mas espacios y unicode, para aceptar ñs y acentos
            'password' => 'min:6',
            //'password_confirmation' => 'between:6,11',
        ]
    ];

    /**
     * Validates the given user. Should check if all the fields are correctly.
     *
     * @param ConfideUserInterface $user Instance to be tested.
     *
     * @return boolean True if the $user is valid.
     */
    public function validate(ConfideUserInterface $user, $ruleset = 'create')
    {
        // Set the $repo as a ConfideRepository object
        $this->repo = App::make('confide.repository');

        // Validate object
        $result = $this->validateAttributes($user, $ruleset) ? true : false;
        $result = ($this->validatePassword($user) && $result) ? true : false;
        //dd($result);
        $result = ($this->validateIsUnique($user) && $result) ? true : false;
/*
        //
        //if(trim($user->password) !== '') {
            //dd($user->getOriginal('password'));
            if ($user->password === $user->password_confirmation) {
                // Hashes password and unset password_confirmation field
                //dd($user);
                $hash = App::make('hash');
                $user->password = $hash->make($user->password);
                unset($user->password_confirmation);
            } else {
                $this->attachErrorMsg(
                    $user,
                    'confide::confide.alerts.password_confirmation',
                    'password_confirmation'
                );
                return false;
            }
        //}
*/
        return $result;
    }

    /**
     * Validates the password and password_confirmation of the given user.
     *
     * @param ConfideUserInterface $user
     *
     * @return boolean True if password is valid.
     */
    public function validatePassword(ConfideUserInterface $user)
    {
        $hash = App::make('hash');

        if ( $user->getOriginal('password') == $user->password ) {
            return true;
        }

        if ( $user->password != $user->password_confirmation ) {
            $this->attachErrorMsg(
                $user,
                'confide::confide.alerts.password_confirmation',
                'password_confirmation'
            );
            return false;
        }

         // Hashes password and unset password_confirmation field
        $user->password = $hash->make($user->password);

        unset($user->password_confirmation);

        return true;
    }

    /**
     * Validates if the given user is unique. If there is another
     * user with the same credentials but a different id, this
     * method will return false.
     *
     * @param ConfideUserInterface $user
     *
     * @return boolean True if user is unique.
     */
    public function validateIsUnique(ConfideUserInterface $user)
    {
        $identity = [
           // 'email'    => $user->email,
            'username' => $user->username,
        ];

        foreach ($identity as $attribute => $value) {

            $similar = $this->repo->getUserByIdentity([$attribute => $value]);

            if (!$similar || $similar->getKey() == $user->getKey()) {
                unset($identity[$attribute]);
            } else {
                $this->attachErrorMsg(
                    $user,
                    'confide::confide.alerts.duplicated_credentials',
                    $attribute
                );
            }

        }

        if (!$identity) {
            return true;
        }

        return false;
    }

    /**
     * Uses Laravel Validator in order to check if the attributes of the
     * $user object are valid for the given $ruleset.
     *
     * @param ConfideUserInterface $user
     * @param string               $ruleset The name of the key in the UserValidator->$rules array
     *
     * @return boolean True if the attributes are valid.
     */
    public function validateAttributes(ConfideUserInterface $user, $ruleset = 'create')
    {
        $attributes = $user->toArray();

        // Force getting password since it may be hidden from array form
        $attributes['password'] = $user->getAuthPassword();

        $rules = $this->rules[$ruleset];

        $validator = App::make('validator')->make($attributes, $rules);

        // Validate and attach errors
        if ($validator->fails()) {
            $user->errors = $validator->messages();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Creates a \Illuminate\Support\MessageBag object, add the error message
     * to it and then set the errors attribute of the user with that bag.
     *
     * @param ConfideUserInterface $user
     * @param string               $errorMsg The error message.
     * @param string               $key      The key if the error message.
     */
    public function attachErrorMsg(ConfideUserInterface $user, $errorMsg, $key = 'confide')
    {
        $messageBag = $user->errors;

        if (! $messageBag instanceof MessageBag) {
            $messageBag = App::make('Illuminate\Support\MessageBag');
        }

        $messageBag->add($key, Lang::get($errorMsg));
        $user->errors = $messageBag;
    }
}
