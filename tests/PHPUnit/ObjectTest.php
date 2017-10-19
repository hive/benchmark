<?php


    class testObject extends base
    {

        public function testSanity ()
        {
            $this->assertEquals(1 + 1, 2);
        }


        public function testStartStop ()
        {
            $bm = new \Hive\Benchmark\Object();
            $bm->start('test');
            $bm->stop('test');

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);
        }

        public function testMultipleStartStop()
        {
            $bm = new \Hive\Benchmark\Object();
            $bm->start('test');
            $bm->stop('test');
            $bm->start('test');
            $bm->stop('test');
            $bm->start('test');
            $bm->stop('test');
            $bm->start('test');
            $bm->stop('test');
            $bm->start('test');
            $bm->stop('test');
            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);
        }

        public function testMultipleDifferentStartStop()
        {
            $bm = new \Hive\Benchmark\Object();
            $bm->start('test1');
            $bm->stop('test1');
            $bm->start('test2');
            $bm->stop('test2');
            $bm->start('test1');
            $bm->stop('test1');
            $bm->start('test2');
            $bm->stop('test2');
            $bm->start('test1');
            $bm->stop('test1');

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);

        }

        public function testConfigEnabledFalse()
        {

            $bm = new \Hive\Benchmark\Object(['enabled' => false]);
            $bm->start('test');
            $bm->stop('test');

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);

        }

        public function testInvalidMark ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            $bm = new \Hive\Benchmark\Object();
            $bm->start([]);
            $bm->stop([]);
        }


        public function testEmptyMarkName ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            $bm = new \Hive\Benchmark\Object();

            $bm->start();
            $bm->stop();
        }

        public function testNotRunningException()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');

            $bm = new \Hive\Benchmark\Object();
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



    }
