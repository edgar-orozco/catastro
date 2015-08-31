<?php
class memos_MemosController extends \ BaseController{
    
    public function index ($format = 'html'){
        $title = 'Memorándums';
        
        $tipoPredio =[''=>'--Seleccione una opción--'];
        
        return View::make('reportes.memos.index', compact('title','tipoPredio'));
    }
}