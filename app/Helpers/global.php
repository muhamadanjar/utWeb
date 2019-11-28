<?php namespace App\Helpers;

function multiKeyExists(array $arr, $key){
    // is in base array?
    if (array_key_exists($key, $arr)) {
        return true;
    }
    // check arrays contained in this array
    foreach ($arr as $element) {
        if (is_array($element)) {
            if ($this->multiKeyExists($element, $key)) {
                return true;
            }
        }

    }
    return false;
}