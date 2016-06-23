<?php namespace Hive\Benchmark\Exception;

    /**
     * Finished Running Exception.
     *
     * Called when the library attempts to stop a benchmark which was not started.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     * @copyright (c) 2016 Jamie Peake
     *
     * @package Hive
     * @subpackage Benchmark
     */
    class  NotRunning extends \Hive\Benchmark\Exception
    {

        const CODE = 3;

        /**
         * NotRunning constructor.
         *
         * @param string $name name of the benchmark which wasnt started
         */
        public function __construct($name)
        {

            $code = self::CODE;
            $message = strstr('A benchmark named :name was not started.', [':name' => $name]);
            parent::__construct($message,$code);

        }

    }