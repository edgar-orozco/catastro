<?php
use Symfony\Component\HttpFoundation\Response;
class HomeController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | Se toma de la sesión el rol principal del usuario y se genera su homepage inicial.
    | Si el usuario tiene varios roles se toma el que sea mayor jerárquicamente.
    | TODO: generar una mejor configuración de los homepage iniciales asignados a cada rol. ¿talvez se deba agreagar a tabla de roles peso y homepage inicial?
    |
    */
    public function showWelcome()
    {
        if(Auth::guest()) {
            return View::make('index');
        }
        $homepage = "hello";
        if (Confide::user()->hasRole('Super usuario')) {
            $homepage = 'superusuario';
        }
        elseif (Confide::user()->hasRole('Administrador')) {
            $homepage = 'administrador';
        }
        elseif (Confide::user()->hasRole('Supervisor')) {
            $homepage = 'supervisor';
        }
        elseif (Confide::user()->hasRole('Funcionario ventanilla') || Confide::user()->hasRole('Funcionario Administración de Trámite') ) {
            $homepage = 'ventanilla';
        }
        elseif (Confide::user()->hasRole('Funcionario Registro y Valuación')) {
            $homepage = 'registroyvaluacion';
        }
        elseif (Confide::user()->hasRole('Funcionario Dirección General de Catastro')) {
            $homepage = 'direcciongeneralcatastro';
        }
        elseif (Confide::user()->hasRole('Funcionario Subdirección de Catastro')) {
            $homepage = 'subdireccioncatastro';
        }
        elseif (Confide::user()->hasRole('Funcionario Cartografía')) {
            $homepage = 'deptocartografia';
        }
        elseif (Confide::user()->hasRole('Usuario final')) {
            $homepage = 'supervisor';
        }
        elseif (Confide::user()->hasRole('Cartógrafo')) {
            $homepage = 'cartografo';
        }
        elseif (Confide::user()->hasRole('Ejecucion fiscal')) {
            $homepage = 'ejecucionFiscal';
        }
        elseif (Confide::user()->hasRole('Folios')) {
            $homepage = 'folios';
        }
        elseif (Confide::user()->hasRole('Supervisor Cartográfico')) {
            return Redirect::to('cartografia/consultas');
        }
        elseif (Confide::user()->hasRole('Folios usuario')) {
            $homepage = 'folios';
        }
        elseif (Confide::user()->hasRole('Folios municipio')) {
            return Redirect::to('/entregafoliosmunicipal');
        }
        elseif (Confide::user()->hasRole('Complementarios')) {
            return Redirect::to('/compleme');
        }
        elseif (Confide::user()->hasRole('Usuario de Notaría')) {
            return Redirect::to('/ofvirtual/notario');
        }
        elseif (Confide::user()->hasRole('Perito Valuador')) {

            return Redirect::to('/corevat/index');
        }
        elseif (Confide::user()->hasRole('Usuario de kiosko')) {
            return Redirect::to('/kiosko/solicitud');
        }
        return View::make($homepage);
    }
} 