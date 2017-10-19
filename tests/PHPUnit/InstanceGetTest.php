<?php

class testInstanceGet extends base
{

    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


    public function testStartStopGet ()
    {
        \Hive\Benchmark\Instance::start(__METHOD__);
        \Hive\Benchmark\Instance::stop(__METHOD__);

        $result = \Hive\Benchmark\Instance::get(__METHOD__);

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

        $result = \Hive\Benchmark\Instance::get(__METHOD__);

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

    public function testMultipleDifferentStartStop()
    {
        \Hive\Benchmark\Instance::start(__METHOD__ .'1');
        \Hive\Benchmark\Instance::stop(__METHOD__ . '1');

        \Hive\Benchmark\Instance::start(__METHOD__ .'2');
        \Hive\Benchmark\Instance::stop(__METHOD__ . '2');

        \Hive\Benchmark\Instance::start(__METHOD__ .'1');
        \Hive\Benchmark\Instance::stop(__METHOD__ . '1');

        \Hive\Benchmark\Instance::start(__METHOD__ .'2');
        \Hive\Benchmark\Instance::stop(__METHOD__ . '2');

        \Hive\Benchmark\Instance::start(__METHOD__ .'1');
        \Hive\Benchmark\Instance::stop(__METHOD__ . '1');

        $result = \Hive\Benchmark\Instance::get(__METHOD__ . '1');

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

        $result = $result = \Hive\Benchmark\Instance::get(__METHOD__ . '2');

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



    public function testInvalidMark ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');

        \Hive\Benchmark\Instance::start([]);
        \Hive\Benchmark\Instance::stop([]);
        \Hive\Benchmark\Instance::get([]);
    }


    public function testEmptyGetMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');

        $bm = new \Hive\Benchmark\Object();
        \Hive\Benchmark\Instance::get();

    }

    public function testDoesNotExistException()
    {
        $bm = new \Hive\Benchmark\Object();

        $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

        \Hive\Benchmark\Instance::get(__METHOD__);
    }

    public function tearDown()
    {
        \Hive\Benchmark\Instance::destroy();
    }


}
