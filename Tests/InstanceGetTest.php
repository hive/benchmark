<?php

    class testInstanceGet extends PHPUnit_Framework_TestCase
    {

        public function testSanity()
        {
            $this->assertEquals(1 + 1, 2);
        }
    
        public function testNotRunningException()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');
            \Hive\Benchmark\Instance::Stop('simple');
        }

        public function testStoppedRunningException()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\StoppedRunning');

            \Hive\Benchmark\Instance::Start('simple');
            \Hive\Benchmark\Instance::Stop('simple');
            \Hive\Benchmark\Instance::Stop('simple');
        }

        public function strToFloat($variable)
        {
            if (is_string($variable)) {
                $value = floatval(str_replace(',', '', $variable));

                return $value;
            }
        }
    }
