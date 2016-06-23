<?php namespace Hive\Benchmark\Exception;

    /**
     * Finished Running Exception
     *
     * Called when the library attempts to stop a benchmark which has already been stopped
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     * @copyright (c) 2016 Jamie Peake
     *
     * @package Hive
     * @subpackage Benchmark
     */
    class FinishedRunning extends \Hive\Benchmark\Exception
    {

        const CODE = 2;

        /**
         * FinishedRunning constructor.
         *
         * @param string $name of the benchmark which has already finished
         */
        public function __construct($name)
        {

            $code = self::CODE;
            $message = strstr('A benchmark named :name has already been stopped.', [':name' => $name]);
            parent::__construct($message,$code);

        }

    }