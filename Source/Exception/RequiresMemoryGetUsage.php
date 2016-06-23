<?php namespace Hive\Benchmark\Exception;

    /**
     * Requires Memory Get Usage Exception
     *
     * Called when the library has memory benchmarks enabled but no way to get the memory data
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     * @copyright (c) 2016 Jamie Peake
     *
     * @package Hive
     * @subpackage Benchmark
     */
    class RequiresMemoryGetUsage extends \Hive\Benchmark\Exception
    {

        const CODE = 4;

        public function __construct()
        {

            $message = 'Unable to access the php function memory_get_usage(), if not accessible run benchmark again with memory benchmarking turned off';

            parent::__construct($message, self::CODE);

        }

    }