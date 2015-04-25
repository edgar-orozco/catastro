<?php
setlocale(LC_ALL,'es_ES');
class Consulta_ConsultaController extends BaseController {



 public function pdf()
{
   $vista = View::make('CartaInvitacion.creditofiscal');
   $pdf = PDF::load($vista)->show("credito");
   $response = Response::make($pdf, 2000);
   $response->header('Content-Type', 'application/pdf');
   return $response;
}
}

