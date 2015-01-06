<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "debe ser aceptado.",
	"active_url"           => "no es un URL válido.",
	"after"                => "debe ser una fecha después de :date.",
	"alpha"                => "debe contener sólo letras.",
	"alpha_dash"           => "debe contener sólo letras, números y guiones.",
	"alpha_num"            => "debe contener sólo letras y números.",
	"array"                => "debe ser un arreglo.",
	"before"               => "debe ser una fecha anterior a :date.",
	"between"              => array(
		"numeric" => "debe estar entr :min a :max.",
		"file"    => "debe ser de :min a :max kilobytes.",
		"string"  => "debe ser de :min a :max caracteres.",
		"array"   => "debe ser entre :min y :max elementos.",
	),
	"confirmed"            => "La confirmación no coincide.",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => "The :attribute must be between :min and :max digits.",
	"email"                => "debe ser una cuenta de correo válida.",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "debe ser un número entero.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => array(
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "The :attribute may not be greater than :max characters.",
		"array"   => "The :attribute may not have more than :max items.",
	),
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => array(
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	),
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "es un dato requerido.",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"               => "Ya existe en el sistema, por favor utilice otros datos.",
	"url"                  => "The :attribute format is invalid.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
        'nombre' => array(
			'alpha_spaces' => 'El nombre de una persona lo componen letras y espacios solamente.',
		),
        'apepat' => array(
            'alpha_spaces' => 'El apellido de una persona lo componen letras y espacios solamente.',
        ),
        'apemat' => array(
            'alpha_spaces' => 'El apellido de una persona lo componen letras y espacios solamente.',
        ),
        'username' => array(
            'alpha_num_dot' => 'El nombre de usuario sólo debe contener letras, números, guión bajo, guión medio y punto',
        ),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
