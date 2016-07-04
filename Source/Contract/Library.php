<?php namespace Hive\Benchmark\Contract;

    /**
     * Library Interface.
     *
     * Interface for the library used as a contact.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     *
     * @package Hive
     * @subpackage Benchmark
     *
     * @copyright (c) 2016 Jamie Peake
     */
    interface Library
    {
        /**
         * Starts a benchmark of give name.
         *
         * @param string $name the benchmark to start.
         *
         * @return void
         */
        public function start($name);

        /**
         * Stops a benchmark of given name.
         *
         * @param string $name the benchmark to stop.
         *
         * @return void
         */
        public function stop ($name);

        /**
         * Get benchmark's details
         *
         * @param string $name the benchmark to get the details of.
         *
         * @return array
         */
        public function details($name);

    }