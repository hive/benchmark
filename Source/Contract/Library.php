<?php namespace Hive\Benchmark\Contract;

    /**
     * Library Interface.
     *
     * Interface for the library.
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

        public function start($name);

        public function stop ($name);

        public function get($name);

    }