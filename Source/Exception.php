<?php namespace Hive\Benchmark;

    /**
     * Requires Memory Get Usage Exception.
     *
     * Called when the library has memory benchmarks enabled but no way to get the memory data.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     *
     * @package Hive
     * @subpackage Benchmark
     *
     * @copyright (c) 2016 Jamie Peake
     */
    class Exception extends \Exception
    {

        /**
         * Arbitrarily assigned vendor exception code
         * used to prefix all hive exceptions.
         */
        const VENDOR = 8883;

        /**
         * Package exception code, sequential package numbers.
         */
        const PACKAGE = 1;

        public function __construct($message = null, $code = null)
        {

            // Call the parent with the message and our now unique error code
            parent::__construct($message, self::VENDOR.self::PACKAGE.$code);

        }

    }