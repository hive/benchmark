<?php

    class testInstanceGet extends base
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

    }
