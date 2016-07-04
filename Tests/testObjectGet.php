<?php


class TestObjectGet extends PHPUnit_Framework_TestCase
{
    public function testSanity()
    {
        $this->assertEquals(1+1, 2);
    }

    public function testGetSingleStructure()
    {
        $bm = new \Hive\Benchmark\Object();

        $bm->start('simple');
        $bm->stop('simple');

        $result = $bm->get('simple');

        // Make sure the array exists
        $this->assertEquals(3, count($result));

        // Ensure we have our Keys
        $this->assertArrayHasKey('count', $result);
        $this->assertArrayHasKey('time', $result);
        $this->assertArrayHasKey('memory', $result);

        // Test our Keys
        $this->assertEquals(1, $result['count']);

        // Time
        $this->assertEquals(5, count($result['time']));
        $this->assertArrayHasKey('total', $result['time']);
        $this->assertArrayHasKey('min', $result['time']);
        $this->assertArrayHasKey('max', $result['time']);
        $this->assertArrayHasKey('mean', $result['time']);
        $this->assertArrayHasKey('median', $result['time']);

        // Memory
        $this->assertEquals(5, count($result['memory']));
        $this->assertArrayHasKey('total', $result['memory']);
        $this->assertArrayHasKey('min', $result['memory']);
        $this->assertArrayHasKey('max', $result['memory']);
        $this->assertArrayHasKey('mean', $result['memory']);
        $this->assertArrayHasKey('median', $result['memory']);

        // As we only have one benchmark, test that all the values are the same
        $this->assertEquals($result['time']['total'], $result['time']['min']);
        $this->assertEquals($result['time']['total'], $result['time']['max']);
        $this->assertEquals($result['time']['total'], $result['time']['mean']);
        $this->assertEquals($result['time']['total'], $result['time']['median']);

        // Now test all the memory usage is the same
        $this->assertEquals($result['memory']['total'], $result['memory']['min']);
        $this->assertEquals($result['memory']['total'], $result['memory']['max']);
        $this->assertEquals($result['memory']['total'], $result['memory']['mean']);
        $this->assertEquals($result['memory']['total'], $result['memory']['median']);
    }

    public function testGetMultipleStructure()
    {
        $bm = new \Hive\Benchmark\Object();

        $bm->start('first');
        $bm->start('second');
        $bm->stop('second');
        $bm->stop('first');

        $first  = $bm->get('first');
        $second = $bm->get('second');

        // Make sure the array exists
        $this->assertEquals(3, count($second));

        // Ensure we have our Keys
        $this->assertArrayHasKey('count', $second);
        $this->assertArrayHasKey('time', $second);
        $this->assertArrayHasKey('memory', $second);

        // Test our Keys
        $this->assertEquals(1, $second['count']);

        // Time
        $this->assertEquals(5, count($second['time']));
        $this->assertArrayHasKey('total', $second['time']);
        $this->assertArrayHasKey('min', $second['time']);
        $this->assertArrayHasKey('max', $second['time']);
        $this->assertArrayHasKey('mean', $second['time']);
        $this->assertArrayHasKey('median', $second['time']);

        // Memory
        $this->assertEquals(5, count($second['memory']));
        $this->assertArrayHasKey('total', $second['memory']);
        $this->assertArrayHasKey('min', $second['memory']);
        $this->assertArrayHasKey('max', $second['memory']);
        $this->assertArrayHasKey('mean', $second['memory']);
        $this->assertArrayHasKey('median', $second['memory']);
    }


    public function testGetNestedStructure()
    {
        $bm = new \Hive\Benchmark\Object();

        $bm->start('first');
        $bm->start('second');
        $bm->stop('second');
        $bm->stop('first');

        $first  = $bm->get('first');
        $second = $bm->get('second');

        // Make sure the array exists
        $this->assertEquals(3, count($second));

        // Ensure we have our Keys
        $this->assertArrayHasKey('count', $second);
        $this->assertArrayHasKey('time', $second);
        $this->assertArrayHasKey('memory', $second);

        // Test our Keys
        $this->assertEquals(1, $second['count']);

        // Time
        $this->assertEquals(5, count($second['time']));
        $this->assertArrayHasKey('total', $second['time']);
        $this->assertArrayHasKey('min', $second['time']);
        $this->assertArrayHasKey('max', $second['time']);
        $this->assertArrayHasKey('mean', $second['time']);
        $this->assertArrayHasKey('median', $second['time']);

        // Memory
        $this->assertEquals(5, count($second['memory']));
        $this->assertArrayHasKey('total', $second['memory']);
        $this->assertArrayHasKey('min', $second['memory']);
        $this->assertArrayHasKey('max', $second['memory']);
        $this->assertArrayHasKey('mean', $second['memory']);
        $this->assertArrayHasKey('median', $second['memory']);

        // Its nested first always has to be greater then second
        $this->assertGreaterThan($second['time']['total'], $first['time']['total']);
        $this->assertGreaterThan($second['time']['min'], $first['time']['min']);
        $this->assertGreaterThan($second['time']['max'], $first['time']['max']);
        $this->assertGreaterThan($second['time']['mean'], $first['time']['mean']);
        $this->assertGreaterThan($second['time']['median'], $first['time']['median']);

        // Its nested first always has to be greater then second
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['total'])), floatval(str_replace(",", "", $first['memory']['total'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $first['memory']['min'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['max'])), floatval(str_replace(",", "", $first['memory']['max'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['mean'])), floatval(str_replace(",", "", $first['memory']['mean'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['median'])), floatval(str_replace(",", "", $first['memory']['median'])));
    }

    public function testGetRepeatStructure()
    {
        $bm = new \Hive\Benchmark\Object();

        $bm->start('first');
        $bm->stop('first');

        $bm->start('first');
        $bm->stop('first');

        $bm->start('first');
        $bm->stop('first');

        $bm->start('first');
        $bm->stop('first');

        $bm->start('first');
        $bm->stop('first');

        $first = $bm->get('first');

        // Make sure the array exists
        $this->assertEquals(3, count($first));

        // Ensure we have our Keys
        $this->assertArrayHasKey('count', $first);
        $this->assertArrayHasKey('time', $first);
        $this->assertArrayHasKey('memory', $first);

        // Test our Keys
        $this->assertEquals(5, $first['count']);

        // Time
        $this->assertEquals(5, count($first['time']));
        $this->assertArrayHasKey('total', $first['time']);
        $this->assertArrayHasKey('min', $first['time']);
        $this->assertArrayHasKey('max', $first['time']);
        $this->assertArrayHasKey('mean', $first['time']);
        $this->assertArrayHasKey('median', $first['time']);

        // Memory
        $this->assertEquals(5, count($first['memory']));
        $this->assertArrayHasKey('total', $first['memory']);
        $this->assertArrayHasKey('min', $first['memory']);
        $this->assertArrayHasKey('max', $first['memory']);
        $this->assertArrayHasKey('mean', $first['memory']);
        $this->assertArrayHasKey('median', $first['memory']);
    }

    public function testGetRepeatNestedStructure()
    {
        $bm = new \Hive\Benchmark\Object();

        $bm->start('first');

        for ($i=0; $i<1000; $i++) {
            $bm->start('second');
            $bm->start('third');
            $bm->stop('second');
            $bm->start('second');
            $bm->stop('second');
            $bm->stop('third');
        }
        $bm->stop('first');

        $first  = $bm->get('first');
        $second = $bm->get('second');
        $third  = $bm->get('third');

        // Make sure the array exists
        $this->assertEquals(3, count($first));
        $this->assertEquals(3, count($second));
        $this->assertEquals(3, count($third));

        // Ensure we have our Keys
        $this->assertArrayHasKey('count', $first);
        $this->assertArrayHasKey('time', $first);
        $this->assertArrayHasKey('memory', $first);

        $this->assertArrayHasKey('count', $second);
        $this->assertArrayHasKey('time', $second);
        $this->assertArrayHasKey('memory', $second);

        $this->assertArrayHasKey('count', $third);
        $this->assertArrayHasKey('time', $third);
        $this->assertArrayHasKey('memory', $third);


        // Test our Keys
        $this->assertEquals(1, $first['count']);
        $this->assertEquals(2000, $second['count']);
        $this->assertEquals(1000, $third['count']);

        // Time
        $this->assertEquals(5, count($first['time']));
        $this->assertArrayHasKey('total', $first['time']);
        $this->assertArrayHasKey('min', $first['time']);
        $this->assertArrayHasKey('max', $first['time']);
        $this->assertArrayHasKey('mean', $first['time']);
        $this->assertArrayHasKey('median', $first['time']);

        $this->assertEquals(5, count($second['time']));
        $this->assertArrayHasKey('total', $second['time']);
        $this->assertArrayHasKey('min', $second['time']);
        $this->assertArrayHasKey('max', $second['time']);
        $this->assertArrayHasKey('mean', $second['time']);
        $this->assertArrayHasKey('median', $second['time']);

        $this->assertGreaterThan($second['time']['mean'], $second['time']['total']);
        $this->assertGreaterThan($second['time']['min'], $second['time']['max']);

        $this->assertEquals(5, count($third['time']));
        $this->assertArrayHasKey('total', $third['time']);
        $this->assertArrayHasKey('min', $third['time']);
        $this->assertArrayHasKey('max', $third['time']);
        $this->assertArrayHasKey('mean', $third['time']);
        $this->assertArrayHasKey('median', $third['time']);

        $this->assertGreaterThan($third['time']['mean'], $third['time']['total']);
        $this->assertGreaterThan($third['time']['min'], $third['time']['max']);

        // Memory
        $this->assertEquals(5, count($first['memory']));
        $this->assertArrayHasKey('total', $first['memory']);
        $this->assertArrayHasKey('min', $first['memory']);
        $this->assertArrayHasKey('max', $first['memory']);
        $this->assertArrayHasKey('mean', $first['memory']);
        $this->assertArrayHasKey('median', $first['memory']);

        $this->assertEquals(floatval(str_replace(",", "", $first['memory']['mean'])), floatval(str_replace(",", "", $first['memory']['total'])));
        $this->assertEquals(floatval(str_replace(",", "", $first['memory']['min'])), floatval(str_replace(",", "", $first['memory']['max'])));

        $this->assertEquals(5, count($second['memory']));
        $this->assertArrayHasKey('total', $second['memory']);
        $this->assertArrayHasKey('min', $second['memory']);
        $this->assertArrayHasKey('max', $second['memory']);
        $this->assertArrayHasKey('mean', $second['memory']);
        $this->assertArrayHasKey('median', $second['memory']);

        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['mean'])), floatval(str_replace(",", "", $second['memory']['total'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $second['memory']['max'])));

        $this->assertEquals(5, count($third['memory']));
        $this->assertArrayHasKey('total', $third['memory']);
        $this->assertArrayHasKey('min', $third['memory']);
        $this->assertArrayHasKey('max', $third['memory']);
        $this->assertArrayHasKey('mean', $third['memory']);
        $this->assertArrayHasKey('median', $third['memory']);

        $this->assertGreaterThan(floatval(str_replace(",", "", $third['memory']['mean'])), floatval(str_replace(",", "", $third['memory']['total'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $third['memory']['min'])), floatval(str_replace(",", "", $third['memory']['max'])));
    }

    public function testGetRepeatNestedStructureLarge()
    {
        $bm = new \Hive\Benchmark\Object();

        $bm->start('first');

        $memory = [];
        for ($i=0; $i<10000; $i++) {
            $bm->start('second');
            $memory[] = $i;
            $bm->stop('second');
        }
        $bm->stop('first');

        $first  = $bm->get('first');
        $second = $bm->get('second');

        // Time
        $this->assertEquals(5, count($second['time']));
        $this->assertArrayHasKey('total', $second['time']);
        $this->assertArrayHasKey('min', $second['time']);
        $this->assertArrayHasKey('max', $second['time']);
        $this->assertArrayHasKey('mean', $second['time']);
        $this->assertArrayHasKey('median', $second['time']);

        $this->assertGreaterThan($second['time']['total'], $first['time']['total']);
        $this->assertGreaterThan($second['time']['max'], $first['time']['max']);
        $this->assertGreaterThan($second['time']['min'], $first['time']['mean']);
        $this->assertGreaterThan($second['time']['min'], $first['time']['median']);

        $this->assertGreaterThan($second['time']['mean'], $second['time']['total']);
        $this->assertGreaterThan($second['time']['min'], $second['time']['max']);
        $this->assertGreaterThan($second['time']['min'], $second['time']['mean']);
        $this->assertGreaterThan($second['time']['min'], $second['time']['median']);

        $this->assertEquals(5, count($second['memory']));
        $this->assertArrayHasKey('total', $second['memory']);
        $this->assertArrayHasKey('min', $second['memory']);
        $this->assertArrayHasKey('max', $second['memory']);
        $this->assertArrayHasKey('mean', $second['memory']);
        $this->assertArrayHasKey('median', $second['memory']);

        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['mean'])), floatval(str_replace(",", "", $first['memory']['total'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $first['memory']['max'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $first['memory']['mean'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $first['memory']['median'])));

        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['mean'])), floatval(str_replace(",", "", $second['memory']['total'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $second['memory']['max'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $second['memory']['mean'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $second['memory']['median'])));
    }

    public function testGetRepeatNestedStructureMany()
    {
        $bm = new \Hive\Benchmark\Object();
        $bm->start('first');
        for ($i=0; $i<10000; $i++) {
            $bm->start('second_' . $i);
            $memory[] = $i;
            $bm->stop('second_' .$i);
        }
        $bm->stop('first');

        $first  = $bm->get('first');
        $second = $bm->get('second_'. rand(1, 10000));

        // Time
        $this->assertEquals(5, count($second['time']));
        $this->assertArrayHasKey('total', $second['time']);
        $this->assertArrayHasKey('min', $second['time']);
        $this->assertArrayHasKey('max', $second['time']);
        $this->assertArrayHasKey('mean', $second['time']);
        $this->assertArrayHasKey('median', $second['time']);

        $this->assertGreaterThan($second['time']['total'], $first['time']['total']);
        $this->assertGreaterThan($second['time']['max'], $first['time']['max']);
        $this->assertGreaterThan($second['time']['min'], $first['time']['mean']);
        $this->assertGreaterThan($second['time']['min'], $first['time']['median']);

        $this->assertEquals(5, count($second['memory']));
        $this->assertArrayHasKey('total', $second['memory']);
        $this->assertArrayHasKey('min', $second['memory']);
        $this->assertArrayHasKey('max', $second['memory']);
        $this->assertArrayHasKey('mean', $second['memory']);
        $this->assertArrayHasKey('median', $second['memory']);

        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['mean'])), floatval(str_replace(",", "", $first['memory']['total'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $first['memory']['max'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $first['memory']['mean'])));
        $this->assertGreaterThan(floatval(str_replace(",", "", $second['memory']['min'])), floatval(str_replace(",", "", $first['memory']['median'])));
    }
}