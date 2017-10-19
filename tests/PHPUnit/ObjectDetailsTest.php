<?php

class testObjectDetails extends base
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
        $result = $bm->details('test');

        $this->assertEquals(1, count($result));
        $this->assertArrayHasKey('count', $result[0]);
        $this->assertEquals($result[0]['count'], count($result));
        $this->assertArrayHasKey('time', $result[0]);
        $this->assertArrayHasKey('memory', $result[0]);

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

    public function testConfigEnabledFalse()
    {

        $bm = new \Hive\Benchmark\Object(['enabled' => false]);
        $bm->start('test');
        $bm->stop('test');
        $result = $bm->details('test');

        $this->assertEmpty($result);
    }

    public function testInvalidDetailsMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $bm = new \Hive\Benchmark\Object();
        $bm->details(new stdClass());

    }

    public function testDetailsMarkNameNotRunning ()
    {
        $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');

        $bm = new \Hive\Benchmark\Object();
        $bm->details('bannana');

    }

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



    public function testEmptyDetailsMarkName ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $bm = new \Hive\Benchmark\Object();
        $bm->details();

    }

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
