<?php

namespace App\Inspections;

class Spam {

    protected $inspections = [
        InvalidWords::class,
        KeyheldDown::class
    ];

    public function detect($body) {

        foreach ($this->inspections as $inspction) {
            app($inspction)->detect($body);
        }

        return false;
    } 

}