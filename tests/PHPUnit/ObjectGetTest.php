<?php

    class testObjectGet extends base
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

        public function testConfigEnabledFalse()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

            $bm = new \Hive\Benchmark\Object(['enabled' => false]);
            $bm->start('test');
            $bm->stop('test');
            $bm->get('test');
        }

        public function testInvalidMark ()
        {
            $this->setExpectedException('PHPUnit_Framework_Error_Warning');

            $bm = new \Hive\Benchmark\Object();
            $bm->start([]);
            $bm->stop([]);
            $bm->get([]);
        }


        public function testEmptyGetMarkName ()
        {
            $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

            $bm = new \Hive\Benchmark\Object();
            $bm->get();

        }

        public function testDoesNotExistException()
        {
            $bm = new \Hive\Benchmark\Object();

            $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

            $bm->get('simple');
        }

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
