<?php

    class testInstanceMethod extends base
    {
        public function testSanity()
        {
            $this->assertEquals(1 + 1, 2);
        }

        public function testMethodGet ()
        {
            \Hive\Benchmark\Instance::method();
            \Hive\Benchmark\Instance::method();
            $result = \Hive\Benchmark\Instance::get('testInstanceMethod\testMethodGet');
        }

        public function tearDown()
        {
            \Hive\Benchmark\Instance::destroy();
        }

    }
