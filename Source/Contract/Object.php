<?php namespace Hive\Benchmark\Contract;

    /**
     * Object Interface.
     *
     * Interface for the object class used as a contract.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     *
     * @package Hive
     * @subpackage Benchmark
     *
     * @copyright (c) 2016 Jamie Peake
     *
     */
    interface Object extends Library
    {
        /**
         * Get benchmark's results
         *
         * @param string $name the benchmark to get.
         *
         * @return array
         */
        public function get($name);

        /**
         * Get a summary of all benchmarks.
         *
         * @return array
         */
        public function summary();

    }