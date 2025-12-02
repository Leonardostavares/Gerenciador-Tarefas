<?php

namespace App\Service;

class DataCleaner{
    public function clearString(string $value): string {
        return preg_replace('/[^0-9]/', '', $value);}
}
