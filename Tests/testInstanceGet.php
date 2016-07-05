<?php

include __DIR__ . '/../include.php';   

class testInstanceGet extends PHPUnit_Framework_TestCase
{
    public function testSanity()
    {
        $this->assertEquals(1+1, 2);
    }

    public function test() {
        \Hive\Benchmark\Instance::start('test');
        \Hive\Benchmark\Instance::stop('test');
        \Hive\Benchmark\Instance::get('test');
        \Hive\Benchmark\Instance::summary();
    }
}
