<?php

class INPCInexistenteException extends \Exception {
    protected $message = 'El INPC para la fecha solicitada no existe en la base de datos';

}