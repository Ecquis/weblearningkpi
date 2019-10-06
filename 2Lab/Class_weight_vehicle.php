<?php

include_once 'Class_vehicle.php';

class weight_vehicle extends vehicle {
    public $carrying;
    
    public function save () {
        $filename = date('Y_m_d');
        $file = fopen(__DIR__ . "/export/$filename", "a");

        fwrite($file, "weight | ($this->carrying) | ($this->fuel_consump) | ($this->max_speed) | ($this->range) \r\n");

        fclose($file);
        header('Location: /index.php');
    }
}