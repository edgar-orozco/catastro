<?php
/**
 * Usamos este archivo para declarar nuevos tipos de validación no incluidos en Laravel
 */

/**
 * Validador alfanumérico con espacios, valida unicode para poder detectar ñs y acentos
 * útil para campos como nombre y apellidos de personas.
 */
Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\s]+$/u', $value);
});

/**
 * Valida alfanuméricos mas punto, útil para tener nombres de usuario con puntos.
 */
Validator::extend('alpha_num_dot', function($attribute, $value)
{
    return preg_match('/^[a-zA-Z0-9-_\.]+$/', $value);
});

