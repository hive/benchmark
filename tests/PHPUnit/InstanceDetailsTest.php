<?php

class testInstanceDetails extends base
{

    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


    /**
     *
     */
    public function testStartStop ()
    {
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        $result = \Hive\Benchmark\Instance::details('test');

        $this->assertEquals(1, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);

    }

    public function testMultipleStartStop()
    {
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');

        $result = \Hive\Benchmark\Instance::details('test');

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

    public function testMultipleDifferentStartStop()
    {
        \Hive\Benchmark\Instance::start('test1');
        \Hive\Benchmark\Instance::stop('test1');
        \Hive\Benchmark\Instance::start('test2');
        \Hive\Benchmark\Instance::stop('test2');
        \Hive\Benchmark\Instance::start('test1');
        \Hive\Benchmark\Instance::stop('test1');
        \Hive\Benchmark\Instance::start('test2');
        \Hive\Benchmark\Instance::stop('test2');
        \Hive\Benchmark\Instance::start('test1');
        \Hive\Benchmark\Instance::stop('test1');
        $result = \Hive\Benchmark\Instance::details('test1');

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

        $result = \Hive\Benchmark\Instance::details('test2');

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

    public function testConfigEnabledFalse()
    {

        \Hive\Benchmark\Instance::load(['enabled' => false]);
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        $result = \Hive\Benchmark\Instance::details('test');

        $this->assertEmpty($result);
    }

    public function testInvalidDetailsMarkName ()
    {
        //$this->setExpectedException('PHPUnit_Framework_Error_Notice');
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        \Hive\Benchmark\Instance::details(new stdClass());

    }

    public function testDetailsMarkNameNotRunning ()
    {
        $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');

        \Hive\Benchmark\Instance::details('bannana');

    }

    public function testDetailsMarkNameStillRunning ()
    {

        \Hive\Benchmark\Instance::start('test');
        $result = \Hive\Benchmark\Instance::details('test');

        $this->assertEquals(1, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);

    }



    public function testEmptyDetailsMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Notice');
        \Hive\Benchmark\Instance::details();

    }

    public function tearDown()
    {
        \Hive\Benchmark\Instance::destroy();
    }


}
