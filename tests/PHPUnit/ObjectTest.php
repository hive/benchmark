<?php

    /**
     * Class testObject
     *
     * Shallow test initialising the benchmark object,
     * asserts true rather then running any operations.
     */
    class testObject extends base
    {

        /**
         * Sanity check to ensure file is being loading correctly.
         */
        public function testSanity ()
        {
            $this->assertEquals(1 + 1, 2);
        }


        /**
         * Test starting and stopping a benchmark.
         */
        public function testStartStop ()
        {
            $bm = new \Hive\Benchmark\Object();
            $bm->start('test');
            $bm->stop('test');

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);
        }


        /**
         * Start and stop a benchmark multiple times.
         */
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


        /**
         * Start and stop multiple tests at the same time
         */
        public function testMultipleDifferentStartStop()
        {
            $bm = new \Hive\Benchmark\Object();
            $bm->start('test0');
            $bm->start('test1');
            $bm->stop('test1');
            $bm->start('test2');
            $bm->stop('test2');
            $bm->start('test1');
            $bm->stop('test1');
            $bm->start('test2');
            $bm->stop('test2');
            $bm->start('test1');
            $bm->stop('test0');

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);
        }


        /**
         * Test to make sure then the benchmark is disabled,
         * no benchmarks are created.
         */
        public function testConfigEnabledFalse()
        {

            $bm = new \Hive\Benchmark\Object(['enabled' => false]);
            $bm->start('test');
            $bm->stop('test');

            // Assert that there are no exceptions/errors/warning
            $this->assertTrue(true);

        }


        /**
         * Test sending in a invalid parameters
         * @todo php7 - enforce string in interface
         */
        public function testInvalidMark ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            $bm = new \Hive\Benchmark\Object();
            $bm->start([]);
            $bm->stop([]);
        }


        /**
         * Test not sending in a mark
         * @todo 1.1 default to a set benchmark when one is not defined in the paramters.
         */
        public function testEmptyMarkName ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            $bm = new \Hive\Benchmark\Object();

            $bm->start();
            $bm->stop();
        }


        /**
         * Stop a non existent mark.
         */
        public function testNotRunningException()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');

            $bm = new \Hive\Benchmark\Object();
            $bm->stop('simple');
        }


        /**
         * Stop a mark which has already been stopped.
         */
        public function testStoppedRunningException()
        {
            $bm = new \Hive\Benchmark\Object();

            $this->setExpectedException('Hive\Benchmark\Exception\StoppedRunning');

            $bm->start('simple');
            $bm->stop('simple');
            $bm->stop('simple');
        }



    }
