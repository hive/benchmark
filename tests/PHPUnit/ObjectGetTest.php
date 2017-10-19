<?php

    /**
     * Test building a benchmark object and then running the get
     * method and ensuring the results are as expected.
     */
    class testObjectGet extends base
    {

        /**
         * Sanity check tha file is being loaded correctly.
         */
        public function testSanity ()
        {
            $this->assertEquals(1 + 1, 2);
        }


        /**
         * Start, Stop and the Get a mark
         *
         * @output
         * array (size=3)
         *      'count' => int 1
         *      'time' =>
         *          array (size=5)
         *              'total' => string '0.00047207' (length=10)
         *              'min' => string '0.00047207' (length=10)
         *              'max' => string '0.00047207' (length=10)
         *              'mean' => string '0.00047207' (length=10)
         *              'median' => string '0.00047207' (length=10)
         *      'memory' =>
         *          array (size=5)
         *              'total' => string '584' (length=3)
         *              'min' => string '584' (length=3)
         *              'max' => string '584' (length=3)
         *              'mean' => string '584' (length=3)
         *              'median' => string '584' (length=3)
         */
        public function testStartStop ()
        {
            $bm = new \Hive\Benchmark\Object();
            $bm->start('test');
            $bm->stop('test');
            $result = $bm->get('test');

            $this->assertArrayHasKey('count', $result);
            $this->assertEquals(1, $result['count']);

            $this->assertArrayHasKey('time', $result);
            $this->assertArrayHasKey('total', $result['time']);
            $this->assertArrayHasKey('min', $result['time']);
            $this->assertArrayHasKey('max', $result['time']);
            $this->assertArrayHasKey('mean', $result['time']);
            $this->assertArrayHasKey('median', $result['time']);

            // Calculations should all be the same for one item.
            $this->assertEquals($result['time']['total'], $result['time']['min']);
            $this->assertEquals($result['time']['total'], $result['time']['max']);
            $this->assertEquals($result['time']['total'], $result['time']['mean']);
            $this->assertEquals($result['time']['total'], $result['time']['median']);

            $this->assertArrayHasKey('memory', $result);
            $this->assertArrayHasKey('total', $result['memory']);
            $this->assertArrayHasKey('min', $result['memory']);
            $this->assertArrayHasKey('max', $result['memory']);
            $this->assertArrayHasKey('mean', $result['memory']);
            $this->assertArrayHasKey('median', $result['memory']);

            // Calculations should all be the same for one item.
            $this->assertEquals($result['memory']['total'], $result['memory']['min']);
            $this->assertEquals($result['memory']['total'], $result['memory']['max']);
            $this->assertEquals($result['memory']['total'], $result['memory']['mean']);
            $this->assertEquals($result['memory']['total'], $result['memory']['median']);
        }


        /**
         * Start and stop a benchmark multiple times
         *
         * @output
         * array (size=3)
         *     'count' => int 5
         *     'time' =>
         *         array (size=5)
         *             'total' => string '0.00016403' (length=10)
         *             'min' => string '0.00002003' (length=10)
         *             'max' => string '0.00007916' (length=10)
         *             'mean' => string '0.00003281' (length=10)
         *             'median' => string '0.00002003' (length=10)
         *     'memory' =>
         *         array (size=5)
         *             'total' => string '2,024' (length=5)
         *             'min' => string '360' (length=3)
         *             'max' => string '584' (length=3)
         *             'mean' => string '405' (length=3)
         *             'median' => string '360' (length=3)
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
            $result = $bm->get('test');

            $this->assertArrayHasKey('count', $result);
            $this->assertEquals(5, $result['count']);

            $this->assertArrayHasKey('time', $result);
            $this->assertArrayHasKey('total', $result['time']);
            $this->assertArrayHasKey('min', $result['time']);
            $this->assertArrayHasKey('max', $result['time']);
            $this->assertArrayHasKey('mean', $result['time']);
            $this->assertArrayHasKey('median', $result['time']);

            // Calculations should all be the different from the total
            $this->assertNotEquals($result['time']['total'], $result['time']['min']);
            $this->assertNotEquals($result['time']['total'], $result['time']['max']);
            $this->assertNotEquals($result['time']['total'], $result['time']['mean']);
            $this->assertNotEquals($result['time']['total'], $result['time']['median']);

            $this->assertArrayHasKey('memory', $result);
            $this->assertArrayHasKey('total', $result['memory']);
            $this->assertArrayHasKey('min', $result['memory']);
            $this->assertArrayHasKey('max', $result['memory']);
            $this->assertArrayHasKey('mean', $result['memory']);
            $this->assertArrayHasKey('median', $result['memory']);

            // Calculations should all be the different from the total
            $this->assertNotEquals($result['memory']['total'], $result['memory']['min']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['max']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['mean']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['median']);
        }


        /**
         * Start and stop multiple marks
         *
         * @output
         * array (size=3)
         *      'count' => int 3
         *      'time' =>
         *          array (size=5)
         *              'total' => string '0.00014591' (length=10)
         *              'min' => string '0.00002289' (length=10)
         *              'max' => string '0.00009990' (length=10)
         *              'mean' => string '0.00004864' (length=10)
         *              'median' => string '0.00002289' (length=10)
         *      'memory' =>
         *          array (size=5)
         *              'total' => string '1,304' (length=5)
         *              'min' => string '360' (length=3)
         *              'max' => string '584' (length=3)
         *              'mean' => string '435' (length=3)
         *              'median' => string '360' (length=3)
         * @output
         * array (size=3)
         *      'count' => int 2
         *      'time' =>
         *          array (size=5)
         *              'total' => string '0.00002599' (length=10)
         *              'min' => string '0.00001192' (length=10)
         *              'max' => string '0.00001407' (length=10)
         *              'mean' => string '0.00001299' (length=10)
         *              'median' => string '0.00001192' (length=10)
         *      'memory' =>
         *          array (size=5)
         *              'total' => string '800' (length=3)
         *              'min' => string '360' (length=3)
         *              'max' => string '440' (length=3)
         *              'mean' => string '400' (length=3)
         *              'median' => string '360' (length=3)
         */
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
            $result = $bm->get('test1');

            $this->assertArrayHasKey('count', $result);
            $this->assertEquals(3, $result['count']);

            $this->assertArrayHasKey('time', $result);
            $this->assertArrayHasKey('total', $result['time']);
            $this->assertArrayHasKey('min', $result['time']);
            $this->assertArrayHasKey('max', $result['time']);
            $this->assertArrayHasKey('mean', $result['time']);
            $this->assertArrayHasKey('median', $result['time']);

            // Calculations should all be the different from the total
            $this->assertNotEquals($result['time']['total'], $result['time']['min']);
            $this->assertNotEquals($result['time']['total'], $result['time']['max']);
            $this->assertNotEquals($result['time']['total'], $result['time']['mean']);
            $this->assertNotEquals($result['time']['total'], $result['time']['median']);

            $this->assertArrayHasKey('memory', $result);
            $this->assertArrayHasKey('total', $result['memory']);
            $this->assertArrayHasKey('min', $result['memory']);
            $this->assertArrayHasKey('max', $result['memory']);
            $this->assertArrayHasKey('mean', $result['memory']);
            $this->assertArrayHasKey('median', $result['memory']);

            // Calculations should all be the different from the total
            $this->assertNotEquals($result['memory']['total'], $result['memory']['min']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['max']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['mean']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['median']);

            $result = $bm->get('test2');

            $this->assertArrayHasKey('count', $result);
            $this->assertEquals(2, $result['count']);

            $this->assertArrayHasKey('time', $result);
            $this->assertArrayHasKey('total', $result['time']);
            $this->assertArrayHasKey('min', $result['time']);
            $this->assertArrayHasKey('max', $result['time']);
            $this->assertArrayHasKey('mean', $result['time']);
            $this->assertArrayHasKey('median', $result['time']);

            // Calculations should all be the different from the total
            $this->assertNotEquals($result['time']['total'], $result['time']['min']);
            $this->assertNotEquals($result['time']['total'], $result['time']['max']);
            $this->assertNotEquals($result['time']['total'], $result['time']['mean']);
            $this->assertNotEquals($result['time']['total'], $result['time']['median']);

            $this->assertArrayHasKey('memory', $result);
            $this->assertArrayHasKey('total', $result['memory']);
            $this->assertArrayHasKey('min', $result['memory']);
            $this->assertArrayHasKey('max', $result['memory']);
            $this->assertArrayHasKey('mean', $result['memory']);
            $this->assertArrayHasKey('median', $result['memory']);

            // Calculations should all be the different from the total
            $this->assertNotEquals($result['memory']['total'], $result['memory']['min']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['max']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['mean']);
            $this->assertNotEquals($result['memory']['total'], $result['memory']['median']);

        }


        /**
         * Get a mark when the benchmark has been disabled
         * @output Exception
         */
        public function testConfigEnabledFalse()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

            $bm = new \Hive\Benchmark\Object(['enabled' => false]);
            $bm->start('test');
            $bm->stop('test');
            $bm->get('test');
        }


        /**
         * Test sending in an invalid parameter
         * @output Exception
         */
        public function testInvalidMark ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            $bm = new \Hive\Benchmark\Object();
            $bm->start([]);
            $bm->stop([]);
            $bm->get([]);
        }


        /**
         * Get an empty mark
         * @output Exception
         */
        public function testEmptyGetMarkName ()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

            $bm = new \Hive\Benchmark\Object();
            $bm->get();

        }


        /**
         * Attempt to get a mark which doesnt exist
         * @output Exception
         */
        public function testDoesNotExistException()
        {
            $bm = new \Hive\Benchmark\Object();

            $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

            $bm->get('simple');
        }


        /**
         * Forces an unexpected exception
         * @output Exception
         */
        public function testForcedGeneralException ()
        {
            $this->setExpectedException('Hive\Benchmark\Exception');


            $bm = new MockException();
            $bm->start('test');
            $bm->stop('test');
            $bm->setUpException();
            $bm->get('test');
        }

    }
