<?php

    class testObjectGet extends PHPUnit_Framework_TestCase
    {

        public function testSanity()
        {
            $this->assertEquals(1 + 1, 2);
        }

        public function testNotRunningException()
        {
            $bm = new \Hive\Benchmark\Object();

            $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');
            $bm->stop('simple');
        }

        public function testStoppedRunningException()
        {
            $bm = new \Hive\Benchmark\Object();

            $this->setExpectedException('Hive\Benchmark\Exception\StoppedRunning');

            $bm->start('simple');
            $bm->stop('simple');
            $bm->stop('simple');
        }

        public function strToFloat($variable)
        {
            if (is_string($variable)) {
                $value = floatval(str_replace(',', '', $variable));

                return $value;
            }
        }
    }
