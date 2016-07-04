<?php namespace Hive\Benchmark\Exception;

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
    class RequiresMemoryGetUsage extends \Hive\Benchmark\Exception
    {
        /**
         * Exception code, sequential exception numbers.
         */
        const CODE = 4;

        /**
         *  Exception Message to be displayed.
         */
        const MESSAGE = 'Unable to access the php function memory_get_usage(), if not accessible run benchmark again with memory benchmarking turned off';

        /**
         * Requires Memory_Get_Usage constructor, assigns exception code the message.
         */
        public function __construct()
        {
            parent::__construct(self::MESSAGE, self::CODE);
        }

    }