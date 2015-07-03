<?php

class PlanoAcotado {
    private $id;
    private $est;
    private $pv; 
    private $azimut;
    private $distancia;
    private $x;
    private $y;
    private $convergencia;
    private $factor;
    private $latitud;
    private $longitud;
    
    private $rumbo;
    private $rumbo_x;
    private $rumbo_y;
    private $superficie;
    private $perimetro;  
       
    //Calcula la distancia entre dos puntos (x1,y1),(x2,y2)
    public function calculate_distancia($x1,$y1,$x2,$y2){
        $this->distancia = sqrt(pow(($x2-$x1),2)+pow(($y2-$y1),2));
    }
    
    //Calcula el azimut entre dos puntos (x1,y1),(x2,y2)
    public function calculate_azimut($x1, $y1, $x2, $y2){
        if (($y2-$y1)!=0){
            $this->azimut = atan(($x2-$x1)/($y2-$y1));
            $this->azimut = rad2deg($this->azimut);
            if($this->azimut<0){
                $this->azimut = $this->azimut + 360;
            }
        }
        else{
            $this->azimut = 0;
        }
    } 

    //Calcula el rumbo entre dos puntos (x1,y1),(x2,y2)
    public function calculate_rumbo($x1,$y1,$x2,$y2){
        $this->calculate_azimut($x1, $y1, $x2, $y2);
        if(($y2-$y1)>=0 && ($x2-$x1)>=0){
            $this->rumbo_x = "N";
            $this->rumbo = $this->azimut;
            $this->rumbo_y = "E";            
        }
        elseif(($y2-$y1)<0 && ($x2-$x1)>=0){
            $this->rumbo_x = "S";
            $this->rumbo = 180 - $this->azimut;
            $this->rumbo_y = "E";           
        }
        elseif(($y2-$y1)<0 && ($x2-$x1)<0){
            $this->rumbo_x = "S";
            $this->rumbo = $this->azimut + 180;
            $this->rumbo_y = "W";            
        }        
        elseif(($y2-$y1)>=0 && ($x2-$x1)<0){
            $this->rumbo_x = "N";
            $this->rumbo = 360 - $this->azimut;
            $this->rumbo_y = "E";            
        }
    }
    //Obtiene los grados del rumbo
    public function get_rumbo(){
        return $this->rumbo;
    }
    //Obtiene la orientación S (Sur) ó N (Norte) del rumbo   
    public function get_rumbo_x(){
        return $this->rumbo_x;
    }
    //Obtiene la orientación W (Oeste) ó E (Este) del rumbo   
    public function get_rumbo_y(){
        return $this->rumbo_y;
    } 
    
    //Calcula la convergencia
    public function calculate_convergencia($latitud, $longitud){
        $longitudG = 93; //El meridiano central de la zona #15 (Tabasco) es 93°W (Rango 96°W-90°W)
        $d = tan($longitudG + $longitud);
        $W = sin($latitud);        
        $this->convergencia = atan($d*$W);
    }
    
    //Calcula el área del predio basado en los vertices [x,y]
    public function calculate_superficie($predio){
        if (sizeof($predio)>2){
            for($i=0; $i<(sizeof($predio)-1); $i++){
                $s += ($predio[$i]->get_x()*$predio[$i+1]->get_y())-($predio[$i]->get_y()*$predio[$i+1]->get_x());
            }
            
        }
        $this->superficie = abs($s/2);
    }
    //Obtiene el área del predio   
    public function get_superficie(){
        return $this->superficie;
    } 
    //Asigna el área del predio
    public function set_superficie($superficie){
        $this->superficie = $superficie;
    }
    
    //Calcula el perímetro del predio basado en los vertices [x,y]
    public function calculate_perimetro($predio){
        for($i=0; $i<(sizeof($predio)); $i++){
            $this->perimetro += $predio[$i]->get_distancia();
        }
    }
    //Obtiene el perímetro del predio   
    public function get_perimetro(){
        return $this->perimetro;
    } 
    //Asigna el perímetro del predio
    public function set_perimetro($perimetro){
        $this->perimetro = $perimetro;
    }      
    
    //Convierte los grados decimales en grados sexagesimales
    public function cast_grados($grados_decimales){
        $grados = explode(".",$grados_decimales);
        $g = $grados[0];
        
        $minutos_decimales = ($grados_decimales - $g)*60;
        $minutos = explode(".",$minutos_decimales);
        $m =  $minutos[0];

        $segundos_decimales = ($minutos_decimales - $m)*60;
        $segundos = explode(".",$segundos_decimales);
        $s =  $segundos[0];        
        
        $grados_sexagesimal = $g."° ".$m."' ".$s."'' ";
        return $grados_sexagesimal;
    }
    
    
    //Propiedades de la Clase
    public function set_id($id){
        $this->id = $id;
    }
    public function get_id(){
        return $this->id;
    }
    public function set_est($est){
        $this->est = $est;
    }
    public function get_est(){
        return $this->est;
    }
    public function set_pv($pv){
        $this->pv = $pv;
    }
    public function get_pv(){
        return $this->pv;
    }
    public function set_azimut($azimut){
        $this->azimut=$azimut;
    }
    public function get_azimut(){
        return $this->azimut;
    }
    public function set_distancia($distancia){
        $this->distancia = $distancia;
    }
    public function get_distancia(){
        return $this->distancia;
    } 
    public function set_x($x){
        $this->x = $x;
    }
    public function get_x(){
        return $this->x;
    }
    public function set_y($y){
        $this->y = $y;
    }
    public function get_y(){
        return $this->y;
    }
    public function set_convergencia($convergencia){
        $this->convergencia = $convergencia;
    }
    public function get_convergencia(){
        return $this->convergencia;
    }    
    public function set_factor($factor){
        $this->factor = $factor;
    }
    public function get_factor(){
        return $this->factor;
    }
    public function set_latitud($latitud){
        $this->latitud = $latitud;
    }
    public function get_latitud(){
        return $this->latitud;
    }
    public function set_longitud($longitud){
        $this->longitud = $longitud;
    }
    public function get_longitud(){
        return $this->longitud;
    }
}

?>