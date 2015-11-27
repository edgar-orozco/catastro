<?php
class memos_MemosController extends \ BaseController{
    
    public function index ($format = 'html'){
        $title = 'Memorándums';
        
        $tipoPredio =[''=>'--Seleccione una opción--'];
        
        return View::make('reportes.memos.index', compact('title','tipoPredio'));
    }

    public function get_pdf () {

    	$vista = View::make('reportes.memos.memo');
    	$pdf = PDF::load($vista)->show('MEMO');
    	$response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
    }
}