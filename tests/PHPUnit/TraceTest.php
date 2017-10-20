<?php

/**
* Class testInstance
 *
 * Test the instance setup
*/
class testTrace extends base
{

    /**
     * Sanity check against php unit.
     */
    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }


    /**
     * Test starting and stopping
     */
    public function testStartStop ()
    {
        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();

        // Assert that there are no exceptions/errors/warning
        $this->assertTrue(true);
    }


    /**
     * Test the instance multiple times with the same mark
     */
    public function testMultipleStartStop()
    {
        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();
        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();
        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();
        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();
        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();

        // Assert that there are no exceptions/errors/warning
        $this->assertTrue(true);
    }


    /**
     * Test Starting and stopping multiple marks
     */
    public function testMultipleDifferentStartStop()
    {
        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::start('one');
        \Hive\Benchmark\Trace::stop('one');
        \Hive\Benchmark\Trace::start('two');
        \Hive\Benchmark\Trace::stop('two');
        \Hive\Benchmark\Trace::start('two');
        \Hive\Benchmark\Trace::stop('two');
        \Hive\Benchmark\Trace::start('one');
        \Hive\Benchmark\Trace::stop('one');
        \Hive\Benchmark\Trace::start('two');
        \Hive\Benchmark\Trace::stop('two');
        \Hive\Benchmark\Trace::stop();

        // Assert that there are no exceptions/errors/warning
        $this->assertTrue(true);

    }

    // Todo create a new file for testing the setup of instance
    //public function testConfigEnabledFalse()
    //{
    //    \Hive\Benchmark\Instance::init(['enabled' => false]);
    //    \Hive\Benchmark\Trace::start();
    //    \Hive\Benchmark\Trace::stop();
    //
    //    $this->assertTrue(true);
    //}

    public function testInvalidMark ()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Notice');
        //$this->setExpectedException('PHPUnit_Framework_Error_Notice');

        \Hive\Benchmark\Trace::start([]);
        \Hive\Benchmark\Trace::stop([]);
    }


    public function testEmptyMarkName ()
    {

        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();
        $this->assertTrue(true);
    }

    public function testNotRunningException()
    {
        $this->setExpectedException('Hive\Benchmark\Exception\NotRunning');

        Hive\Benchmark\Trace::stop();
    }

    public function testStoppedRunningException()
    {
        $this->setExpectedException('Hive\Benchmark\Exception\StoppedRunning');

        \Hive\Benchmark\Trace::start();
        \Hive\Benchmark\Trace::stop();
        \Hive\Benchmark\Trace::stop();
    }


    public function testChangeConfig()
    {
        // Because of the way that phpUnit works, everything has already been initiated.
        $this->setExpectedException('Hive\Benchmark\Exception\AlreadyInitiated');

        \Hive\Benchmark\Trace::start('test');
        \Hive\Benchmark\Trace::stop('test');

        $result = \Hive\Benchmark\Instance::init(['enabled' => false]);

        \Hive\Benchmark\Trace::start('test');
        \Hive\Benchmark\Trace::stop('test');
        \Hive\Benchmark\Trace::get('test');
    }

}
