<?php

include_once 'Class_vehicle.php';

class pass_vehicle extends vehicle {
    public $price;
    public $quantity;

    public function save () {
        $filename = date('Y_m_d');
        $file = fopen(__DIR__ . "/export/$filename", "a");

        fwrite($file, "pass | ($this->price) | ($this->quantity) | ($this->fuel_consump) | ($this->max_speed) | ($this->range) \r\n");

        fclose($file);
        header('Location: /index.php');
    }
}

