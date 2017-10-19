<?php

class testInstanceSummary extends base
{

    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


    public function testStartStopSummary ()
    {
        
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        $result = \Hive\Benchmark\Instance::summary();

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
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        $result = \Hive\Benchmark\Instance::summary();


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
        \Hive\Benchmark\Instance::start('test0');
        \Hive\Benchmark\Instance::start('test1');
        \Hive\Benchmark\Instance::stop('test1');
        \Hive\Benchmark\Instance::start('test2');
        \Hive\Benchmark\Instance::stop('test2');
        \Hive\Benchmark\Instance::start('test1');
        \Hive\Benchmark\Instance::stop('test1');
        \Hive\Benchmark\Instance::stop('test0');
        $result = \Hive\Benchmark\Instance::summary();

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
        \Hive\Benchmark\Instance::init(['enabled' => false]);

        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        $result = \Hive\Benchmark\Instance::summary();


        $this->assertEmpty($result);
    }

    public function testEmptyMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');

        \Hive\Benchmark\Instance::start();
        \Hive\Benchmark\Instance::stop();
        \Hive\Benchmark\Instance::summary();
    }

    public function tearDown()
    {
        \Hive\Benchmark\Instance::destroy();
    }

}
