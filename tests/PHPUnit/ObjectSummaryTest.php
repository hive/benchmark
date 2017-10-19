<?php

/**
 * Class testObjectSummary
 *
 * Tests the Benchmark Object Summary in various situations
 */
class testObjectSummary extends base
{

    /**
     * Sanity check  php unit
     */
    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


    /**
     * Get the summary.
     *
     * @output
     * array (size=1)
     *  'test' =>
     *  array (size=3)
     *      'count' => int 1
     *      'time' =>
     *          array (size=5)
     *              'total' => string '0.00005603' (length=10)
     *              'min' => string '0.00005603' (length=10)
     *              'max' => string '0.00005603' (length=10)
     *              'mean' => string '0.00005603' (length=10)
     *              'median' => string '0.00005603' (length=10)
     *      'memory' =>
     *          array (size=5)
     *              'total' => string '584' (length=3)
     *              'min' => string '584' (length=3)
     *              'max' => string '584' (length=3)
     *              'mean' => string '584' (length=3)
     *              'median' => string '584' (length=3)
     */
    public function testStartStopSummary ()
    {
        $bm = new \Hive\Benchmark\Object();
        $bm->start('test');
        $bm->stop('test');
        $result = $bm->summary();

        $this->assertArrayHasKey('test', $result);
        $this->assertArrayHasKey('count', $result['test']);
        $this->assertEquals(1, $result['test']['count']);

        $this->assertArrayHasKey('time', $result['test']);
        $this->assertArrayHasKey('total', $result['test']['time']);
        $this->assertArrayHasKey('min', $result['test']['time']);
        $this->assertArrayHasKey('max', $result['test']['time']);
        $this->assertArrayHasKey('mean', $result['test']['time']);
        $this->assertArrayHasKey('median', $result['test']['time']);

        // Calculations should all be the same for one item.
        $this->assertEquals($result['test']['time']['total'], $result['test']['time']['min']);
        $this->assertEquals($result['test']['time']['total'], $result['test']['time']['max']);
        $this->assertEquals($result['test']['time']['total'], $result['test']['time']['mean']);
        $this->assertEquals($result['test']['time']['total'], $result['test']['time']['median']);

        $this->assertArrayHasKey('memory', $result['test']);
        $this->assertArrayHasKey('total', $result['test']['memory']);
        $this->assertArrayHasKey('min', $result['test']['memory']);
        $this->assertArrayHasKey('max', $result['test']['memory']);
        $this->assertArrayHasKey('mean', $result['test']['memory']);
        $this->assertArrayHasKey('median', $result['test']['memory']);

        // Calculations should all be the same for one item.
        $this->assertEquals($result['test']['memory']['total'], $result['test']['memory']['min']);
        $this->assertEquals($result['test']['memory']['total'], $result['test']['memory']['max']);
        $this->assertEquals($result['test']['memory']['total'], $result['test']['memory']['mean']);
        $this->assertEquals($result['test']['memory']['total'], $result['test']['memory']['median']);

    }


    /**
     * Start and stop a mark multiple times
     *
     * @output
     * array (size=1)
     *  'test' =>
     *      array (size=3)
     *      'count' => int 4
     *      'time' =>
     *          array (size=5)
     *              'total' => string '0.00009108' (length=10)
     *              'min' => string '0.00001288' (length=10)
     *              'max' => string '0.00004101' (length=10)
     *              'mean' => string '0.00002277' (length=10)
     *              'median' => string '0.00001288' (length=10)
     *      'memory' =>
     *          array (size=5)
     *              'total' => string '1,664' (length=5)
     *              'min' => string '360' (length=3)
     *              'max' => string '584' (length=3)
     *              'mean' => string '416' (length=3)
     *              'median' => string '360' (length=3)
     */
    public function testMultipleStartStopSummary ()
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
        $result = $bm->summary();


        $this->assertArrayHasKey('test', $result);
        $this->assertArrayHasKey('count', $result['test']);
        $this->assertEquals(4, $result['test']['count']);

        $this->assertArrayHasKey('time', $result['test']);
        $this->assertArrayHasKey('total', $result['test']['time']);
        $this->assertArrayHasKey('min', $result['test']['time']);
        $this->assertArrayHasKey('max', $result['test']['time']);
        $this->assertArrayHasKey('mean', $result['test']['time']);
        $this->assertArrayHasKey('median', $result['test']['time']);


        $this->assertArrayHasKey('memory', $result['test']);
        $this->assertArrayHasKey('total', $result['test']['memory']);
        $this->assertArrayHasKey('min', $result['test']['memory']);
        $this->assertArrayHasKey('max', $result['test']['memory']);
        $this->assertArrayHasKey('mean', $result['test']['memory']);
        $this->assertArrayHasKey('median', $result['test']['memory']);

    }


    /**
     * Start and stop multiple marks, including nested
     *
     * @output
     * array (size=3)
     *  'test0' =>
     *      array (size=3)
     *          'count' => int 1
     *          'time' =>
     *              array (size=5)
     *                  'total' => string '0.00008297' (length=10)
     *                  'min' => string '0.00008297' (length=10)
     *                  'max' => string '0.00008297' (length=10)
     *                  'mean' => string '0.00008297' (length=10)
     *                  'median' => string '0.00008297' (length=10)
     *          'memory' =>
     *              array (size=5)
     *                  'total' => string '5,560' (length=5)
     *                  'min' => string '5,560' (length=5)
     *                  'max' => string '5,560' (length=5)
     *                  'mean' => string '5,560' (length=5)
     *                  'median' => string '5,560' (length=5)
     *  'test1' =>
     *      array (size=3)
     *          'count' => int 2
     *          'time' =>
     *              array (size=5)
     *                  'total' => string '0.00002599' (length=10)
     *                  'min' => string '0.00001192' (length=10)
     *                  'max' => string '0.00001407' (length=10)
     *                  'mean' => string '0.00001299' (length=10)
     *                  'median' => string '0.00001192' (length=10)
     *          'memory' =>
     *              array (size=5)
     *                  'total' => string '944' (length=3)
     *                  'min' => string '360' (length=3)
     *                  'max' => string '584' (length=3)
     *                  'mean' => string '472' (length=3)
     *                  'median' => string '360' (length=3)
     *  'test2' =>
     *      array (size=3)
     *          'count' => int 1
     *          'time' =>
     *          array (size=5)
     *              'total' => string '0.00001097' (length=10)
     *              'min' => string '0.00001097' (length=10)
     *              'max' => string '0.00001097' (length=10)
     *              'mean' => string '0.00001097' (length=10)
     *              'median' => string '0.00001097' (length=10)
     *          'memory' =>
     *              array (size=5)
     *                  'total' => string '440' (length=3)
     *                  'min' => string '440' (length=3)
     *                  'max' => string '440' (length=3)
     *                  'mean' => string '440' (length=3)
     *                  'median' => string '440' (length=3)
     */
    public function testDifferentStartStopSummary ()
    {
        $bm = new \Hive\Benchmark\Object();
        $bm->start('test0');
        $bm->start('test1');
        $bm->stop('test1');
        $bm->start('test2');
        $bm->stop('test2');
        $bm->start('test1');
        $bm->stop('test1');
        $bm->stop('test0');
        $result = $bm->summary();

        $this->assertArrayHasKey('test0', $result);
        $this->assertArrayHasKey('count', $result['test0']);
        $this->assertArrayHasKey('time', $result['test0']);
        $this->assertArrayHasKey('memory', $result['test0']);

        $this->assertArrayHasKey('test1', $result);
        $this->assertArrayHasKey('count', $result['test1']);
        $this->assertArrayHasKey('time', $result['test1']);
        $this->assertArrayHasKey('memory', $result['test1']);


        $this->assertArrayHasKey('test2', $result);
        $this->assertArrayHasKey('count', $result['test2']);
        $this->assertArrayHasKey('time', $result['test2']);
        $this->assertArrayHasKey('memory', $result['test2']);


    }


    /**
     * Get the benchmark summary when Benchmarks are disabled
     * @output
     * array (size=0)
     *  empty
     */
    public function testConfigEnabledFalse()
    {
        $bm = new \Hive\Benchmark\Object(['enabled' => false]);
        $bm->start('test');
        $bm->stop('test');
        $result = $bm->summary();


        $this->assertEmpty($result);
    }


    /**
     * Send a blank object
     * @throws exception
     */
    public function testEmptyMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');

        $bm = new \Hive\Benchmark\Object();
        $bm->start();
        $bm->stop();
        $bm->summary();
    }



}
