<?php namespace Hive\Benchmark\Contract;


    /**
     * Instance Interface
     *
     * Interface for use with the instances.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     * @copyright (c) 2016 Jamie Peake
     *
     * @package Hive
     * @subpackage Benchmark
     */
    interface Instance
    {

        public static function start();
        public static function stop ();
        public static function get();
        public static function method();

    }