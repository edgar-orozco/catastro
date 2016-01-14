<?php
class memos_MemosController extends \BaseController
{
    
    protected $manifestacion;
    protected $valuacionPredio;

    /**
     * Instancia
     * @param Manifestacion $manifestacion
     * @param ValuacionPredio $valuacionPredio
     */

    public function __construct(Manifestacion $manifestacion, ValuacionPredio $valuacionPredio){

        $this->Manifestacion = $manifestacion;
        $this->ValuacionPredio = $valuacionPredio;
    }
    
    public function index ($format = 'html'){

        $clave = '27-008-001-0017-000005';
        //Traemos los datos ya capturados para mostrarlo en memos
        $predio = $this->Manifestacion->where('clave',$clave)->orderBy('id','desc')->first();
        $valuacion = $this->ValuacionPredio->where('clave',$clave)->orderBy('id','desc')->first();
        //dd($predio->propietario);
        $title = 'Memorándums';
        
        return View::make('reportes.memos.index', compact('title','predio','valuacion'));
    }

    public function get_pdf () {

    	$vista = View::make('reportes.memos.memo');
    	$pdf = PDF::load($vista)->show('MEMO');
    	$response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
    }
}