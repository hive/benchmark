<?php namespace Hive\Benchmark\Exception;

    /**
     * Already Running Exception.
     *
     * Called when the library attempts to start a benchmark
     * the same benchmark is already running.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     * @copyright (c) 2016 Jamie Peake
     *
     * @package Hive
     * @subpackage Benchmark
     */
    class AlreadyRunning extends \Hive\Benchmark\Exception
    {

        const CODE = 1;

        /**
         * AlreadyRunning constructor.
         *
         * @param string $name name of the benchmark already running
         */
        public function __construct($name)
        {

            $code = self::CODE;
            $message = strstr('A benchmark named :name is already running, either stop the benchmark named :name or create a benchmark with a new name', [':name' => $name]);
            parent::__construct($message,$code);

        }

    }