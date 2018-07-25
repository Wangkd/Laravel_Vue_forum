<?php

namespace App\Inspections;

class KeyHeldDown {

    public function detect($str) {
        if(preg_match('/(.)\\1{8,}/', $str)) {
            throw new \Exception('Your reply cantains spam');
        }
    }
}