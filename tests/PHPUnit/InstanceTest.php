<?php


    class testInstance extends base
    {

        public function testSanity ()
        {
            $this->assertEquals(1 + 1, 2);
        }


        public function testStartStop ()
        {
            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);
        }

        public function testMultipleStartStop()
        {
            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);
            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);
            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);
            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);
            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);
        }

        public function testMultipleDifferentStartStop()
        {
            \Hive\Benchmark\Instance::start(__METHOD__ . '0');
            \Hive\Benchmark\Instance::start(__METHOD__ . '1');
            \Hive\Benchmark\Instance::stop(__METHOD__ . '1');
            \Hive\Benchmark\Instance::start(__METHOD__ . '2');
            \Hive\Benchmark\Instance::stop(__METHOD__ . '2');
            \Hive\Benchmark\Instance::start(__METHOD__ . '2');
            \Hive\Benchmark\Instance::stop(__METHOD__ . '2');
            \Hive\Benchmark\Instance::start(__METHOD__ . '1');
            \Hive\Benchmark\Instance::stop(__METHOD__ . '1');
            \Hive\Benchmark\Instance::start(__METHOD__ . '2');
            \Hive\Benchmark\Instance::stop(__METHOD__ . '2');
            \Hive\Benchmark\Instance::stop(__METHOD__ . '0');

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);

        }

        public function testConfigEnabledFalse()
        {
            \Hive\Benchmark\Instance::init(['enabled' => false]);
            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);

            $this->assertTrue(true);
        }

        public function testInvalidMark ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            \Hive\Benchmark\Instance::start([]);
            \Hive\Benchmark\Instance::stop([]);
        }


        public function testEmptyMarkName ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            \Hive\Benchmark\Instance::start();
            \Hive\Benchmark\Instance::stop();
        }

        public function testNotRunningException()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');

            Hive\Benchmark\Instance::stop(__METHOD__);
        }

        public function testStoppedRunningException()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\StoppedRunning');

            \Hive\Benchmark\Instance::start(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);
            \Hive\Benchmark\Instance::stop(__METHOD__);
        }


        public function testChangeConfig()
        {
            // Because of the way that phpUnit works, everything has already been initiated.
            $this->setExpectedException('Hive\Benchmark\Exception\AlreadyInitiated');

            \Hive\Benchmark\Instance::start('test');
            \Hive\Benchmark\Instance::stop('test');

            $result = \Hive\Benchmark\Instance::init(['enabled' => false]);

            \Hive\Benchmark\Instance::start('test');
            \Hive\Benchmark\Instance::stop('test');
            \Hive\Benchmark\Instance::get('test');
        }



        public function tearDown()
        {
            \Hive\Benchmark\Instance::destroy();
        }


    }
