<?php

class testObjectSummary extends base
{

    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


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

    public function testConfigEnabledFalse()
    {
        $bm = new \Hive\Benchmark\Object(['enabled' => false]);
        $bm->start('test');
        $bm->stop('test');
        $result = $bm->summary();


        $this->assertEmpty($result);
    }

    public function testEmptyMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');

        $bm = new \Hive\Benchmark\Object();
        $bm->start();
        $bm->stop();
        $bm->summary();
    }



}
