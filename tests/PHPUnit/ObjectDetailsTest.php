<?php

/**
 * Class testObjectDetails
 *
 * Test using the benchmark/details() in various situations.
 */
class testObjectDetails extends base
{

    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


    /**
     * Start stop a mark and then gather the details
     *
     * @output
     * array (size=1)
     *  0 =>
     *      array (size=3)
     *          'time' => string '0.000060081' (length=11)
     *          'count' => int 1
     *          'memory' => int 584
     */
    public function testStartStop ()
    {
        $bm = new \Hive\Benchmark\Object();
        $bm->start('test');
        $bm->stop('test');
        $result = $bm->details('test');

        $this->assertEquals(1, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);

    }


    /**
     * Start and stop the benchmark multiple times.
     *
     * @output
     * array (size=5)
     *  0 =>
     *  array (size=3)
     *      'time' => string '0.000019789' (length=11)
     *      'count' => int 5
     *      'memory' => int 360
     *  1 =>
     *  array (size=3)
     *      'time' => string '0.000020981' (length=11)
     *      'count' => int 5
     *      'memory' => int 360
     *  2 =>
     *  array (size=3)
     *      'time' => string '0.000022173' (length=11)
     *      'count' => int 5
     *      'memory' => int 360
     *  3 =>
     *  array (size=3)
     *      'time' => string '0.000021935' (length=11)
     *      'count' => int 5
     *      'memory' => int 360
     *  4 =>
     *  array (size=3)
     *      'time' => string '0.001728058' (length=11)
     *      'count' => int 5
     *      'memory' => int 584
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

        $result = $bm->details('test');

        $this->assertEquals(5, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));

        $this->assertArrayHasKey('count', $result[1]);
        $this->assertArrayHasKey('time', $result[1]);
        $this->assertArrayHasKey('memory', $result[1]);
        $this->assertEquals($result[1]['count'], count($result));

        $this->assertArrayHasKey('count', $result[2]);
        $this->assertArrayHasKey('time', $result[2]);
        $this->assertArrayHasKey('memory', $result[2]);
        $this->assertEquals($result[2]['count'], count($result));

        $this->assertArrayHasKey('count', $result[3]);
        $this->assertArrayHasKey('time', $result[3]);
        $this->assertArrayHasKey('memory', $result[3]);
        $this->assertEquals($result[3]['count'], count($result));

        $this->assertArrayHasKey('count', $result[4]);
        $this->assertArrayHasKey('time', $result[4]);
        $this->assertArrayHasKey('memory', $result[4]);
        $this->assertEquals($result[4]['count'], count($result));

    }


    /**
     * Start and stop multiple benchmarks
     *
     * @output
     * array (size=3)
     *  0 =>
     *  array (size=3)
     *      'time' => string '0.000011206' (length=11)
     *      'count' => int 3
     *      'memory' => int 360
     *  1 =>
     *  array (size=3)
     *      'time' => string '0.000010967' (length=11)
     *      'count' => int 3
     *      'memory' => int 360
     *  2 =>
     *  array (size=3)
     *      'time' => string '0.000025988' (length=11)
     *      'count' => int 3
     *      'memory' => int 584
     * @output
     * array (size=2)
     *  0 =>
     *  array (size=3)
     *      'time' => string '0.000012875' (length=11)
     *      'count' => int 2
     *      'memory' => int 360
     *  1 =>
     *  array (size=3)
     *      'time' => string '0.000013113' (length=11)
     *      'count' => int 2
     *      'memory' => int 440
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
        $result = $bm->details('test1');

        $this->assertEquals(3, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));

        $this->assertArrayHasKey('count', $result[1]);
        $this->assertArrayHasKey('time', $result[1]);
        $this->assertArrayHasKey('memory', $result[1]);
        $this->assertEquals($result[1]['count'], count($result));

        $this->assertArrayHasKey('count', $result[2]);
        $this->assertArrayHasKey('time', $result[2]);
        $this->assertArrayHasKey('memory', $result[2]);
        $this->assertEquals($result[2]['count'], count($result));

        $result = $bm->details('test2');

        $this->assertEquals(2, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));

        $this->assertArrayHasKey('count', $result[1]);
        $this->assertArrayHasKey('time', $result[1]);
        $this->assertArrayHasKey('memory', $result[1]);
        $this->assertEquals($result[1]['count'], count($result));

    }


    /**
     * Get the details of a mark when it hasn't been enabled,
     * @output
     * array (size=0)
     *  empty
     */
    public function testConfigEnabledFalse()
    {

        $bm = new \Hive\Benchmark\Object(['enabled' => false]);
        $bm->start('test');
        $bm->stop('test');
        $result = $bm->details('test');

        $this->assertEmpty($result);
    }


    /**
     * Attempt to get the details of an invalid details
     * @output Exception
     */
    public function testInvalidDetailsMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $bm = new \Hive\Benchmark\Object();
        $bm->details(new stdClass());

    }


    /**
     * Attempt to get the details of an non existent mark
     * @output Exception
     */
    public function testDetailsMarkNameNotRunning ()
    {
        $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');

        $bm = new \Hive\Benchmark\Object();
        $bm->details('bannana');
    }


    /**
     * Get the details of a benchmark which hasn't stopped
     * @output
     * array (size=1)
     *  0 =>
     *  array (size=3)
     *      'time' => string '0.000023842' (length=11)
     *      'count' => int 1
     *      'memory' => int 720
     */
    public function testDetailsMarkNameStillRunning ()
    {
        $bm = new \Hive\Benchmark\Object();
        $bm->start('test');
        $result = $bm->details('test');

        $this->assertEquals(1, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);
    }


    /**
     * Attempt to get details with out sending in a argument.
     * @output Exception
     */
    public function testEmptyDetailsMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $bm = new \Hive\Benchmark\Object();
        $bm->details();

    }


    /**
     * Attempt to throw an unexpected exception
     * @output Exception
     */
    public function testForcedGeneralException ()
    {
        $this->setExpectedException('Hive\Benchmark\Exception');


        $bm = new MockException();
        $bm->start('test');
        $bm->stop('test');
        $bm->setUpException();
        $bm->details('test');
    }


}
