<?php

namespace App;

class Spam {

    public function detect($body) {

        $this->detectInvalidKeywords($body);

        return false;
    } 

    protected function detectInvalidKeywords($str) {
        $invalidKeywords = [
            'caonima'
        ];

        foreach ($invalidKeywords as $keyword) {
            if(stripos($str, $keyword) !== false) {
                throw new \Exception('Your reply cantains spam');
            }
        }
    }
}