<?php

class UsuariosNotariaHelper{
    /**
     * Función para generar un password aleatorio
     *
     * @param $size
     * @return string
     */
    public static function generarPassword($size){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$size);
    }

    public static function sendEmail(User $user, $password){
        Mail::send('admin.user.notarias.index',
            array(
                'user'      => $user,
                'password'  => $password
            ), function($message) use ($user){
                $message
                    ->to(
                        $user->email, $user->nombreCompleto()
                    )
                    ->subject('Datos de acceso al SICARET');
        });
    }
}