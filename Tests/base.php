<?php

    class base extends PHPUnit_Framework_TestCase
    {
        
        public function strToFloat($variable)
        {
            if (is_string($variable)) {
                $value = floatval(str_replace(',', '', $variable));

                return $value;
            }
        }

    }

