<?php

    class LargeObjectTest extends PHPUnit_Framework_TestCase
    {
        public function testSanity()
        {
            $this->assertEquals(1 + 1, 2);
        }

        public function strToFloat($variable)
        {
            if (is_string($variable)) {
                $value = floatval(str_replace(',', '', $variable));

                return $value;
            }
        }

    }

