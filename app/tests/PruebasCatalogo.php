<?php
class catalogosPruebas extends Illuminate\Foundation\Testing\TestCase{

    
    
  public function statusIndex()
  {
    $response  = $this->call('pos','catalogos/status');
    $response = $this->action('pos', 'catalogos_statusController@index');
    $this -> assertResponseOk();
    $this -> assertEquals('Este es el catalogo de estatus', $response->getContent());
    $this->call();
      
      $this->client->request('GET', 'catalogos/status');
  
      
  }

}
