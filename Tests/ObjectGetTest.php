<?php

    class testObjectGet extends base
    {

        public function testSanity()
        {
            $this->assertEquals(1 + 1, 2);
        }

        public function testNotRunningException()
        {
            $bm = new \Hive\Benchmark\Object();

            $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');
            $bm->stop('simple');
        }

        public function testStoppedRunningException()
        {
            $bm = new \Hive\Benchmark\Object();

            $this->setExpectedException('Hive\Benchmark\Exception\StoppedRunning');

            $bm->start('simple');
            $bm->stop('simple');
            $bm->stop('simple');
        }

    }
