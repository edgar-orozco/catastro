<?php


class PruebasComplementarios extends TestCase{
    
    public function testindex()
    {
         $this->client->request('GET', 'posts');
    }
    
}
