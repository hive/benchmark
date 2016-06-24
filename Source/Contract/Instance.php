<?php namespace Hive\Benchmark\Contract;

    /**
     * Instance Interface
     *
     * Interface for use with the instances.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     *
     * @package Hive
     * @subpackage Benchmark
     *
     * @copyright (c) 2016 Jamie Peake
     */
    interface Instance
    {

        public static function start($name);

        public static function stop($name);

        public static function get($name);

        public static function method();

        public static function summary($name);


    }