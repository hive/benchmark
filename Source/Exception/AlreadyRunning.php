<?php namespace Hive\Benchmark\Exception;

    /**
     * Already Running Exception.
     *
     * Called when the library attempts to start a benchmark
     * the same benchmark is already running.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     *
     * @package Hive
     * @subpackage Benchmark
     *             
     * @copyright (c) 2016 Jamie Peake
     */
    class AlreadyRunning extends \Hive\Benchmark\Exception
    {
        /**
         * Exception code, sequential exception numbers.
         */
        const CODE = 1;

        /**
         * Exception Message to be displayed.
         */
        const MESSAGE = 'A benchmark named :name is already running, either stop the benchmark named :name or create a benchmark with a new name';

        /**
         * Already Running Constructor, assigns exception code and places the message.
         *
         * Will also place the name of the benchmark into the exception message if we have it
         *
         * @param string $name name of the benchmark already running
         */
        public function __construct($name)
        {
            $code       = self::CODE;
            $message    = strtr(self::MESSAGE, [':name' => $name]);

            parent::__construct($message, $code);
        }

    }