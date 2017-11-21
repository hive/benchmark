<?php

class testInstanceInitEnabled extends base
{

    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


    public function testDisabled()
    {
        $this->setExpectedException('Hive\Benchmark\Exception\DoesNotExist');

        \Hive\Benchmark\Instance::load(['enabled' => false]);
        \Hive\Benchmark\Instance::start(__METHOD__);
        \Hive\Benchmark\Instance::stop(__METHOD__);
        \Hive\Benchmark\Instance::get(__METHOD__);

    }

    public function tearDown()
    {
        \Hive\Benchmark\Instance::destroy();
    }


}
