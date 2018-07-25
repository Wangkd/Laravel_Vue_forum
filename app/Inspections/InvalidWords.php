<?php

namespace App\Inspections;

class InvalidWords {

    protected $keywords = [
        'caonima'
    ];

    public function detect($str) {

        foreach ($this->keywords as $keyword) {
            if(stripos($str, $keyword) !== false) {
                throw new \Exception('Your reply cantains spam');
            }
        }
    }
}