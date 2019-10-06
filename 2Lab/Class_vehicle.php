<?php

class vehicle {
    public $fuel_consump;
    public $max_speed;
    public $range;
    
    public function save () {}

    public function calculate () {
        return $this->fuel_consump * $this->range;
    }
}