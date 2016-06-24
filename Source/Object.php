<?php namespace Hive\Benchmark;


    /**
     * Object Library.
     *
     * Allows access to the library through an object.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     *
     * @package Hive
     * @subpackage Benchmark
     *
     * @copyright (c) 2016 Jamie Peake
     */
    class Object extends Library implements Ccontract\Object
    {
        /**
         * Default configuration settings.
         *
         * config['enabled'] boolean Whether or not the benchmark is enabled, set to false if you wish to disabled on production
         *
         * @var array config default object configuration for the library
         */
        private $config = [
            'enabled' => true
        ];

        /**
         * Object constructor.
         *
         * @param array $config
         *
         * @throws Exception\RequiresMemoryGetUsage
         */
        public function __construct($config) {

            /**
             *  Merge the received config with the defaults
             */
            $this->config = array_merge($config, $this->config);

            parent::__construct($config);

        }

        /**
         * Start a benchmark.
         *
         * @param $name string benchmark name
         *
         * @return void
         */
        public function start($name)
        {
            // Config Check : Are Benchmarks enabled
            if ($this->config['enabled']) {
                $this->start($name);
            }
        }

        public function stop ($name)
        {
            // Config Check : Are Benchmarks enabled
            if ($this->config['enabled']) {
                return $this->stop($name);
            }

        }

        public function get($name)
        {
            // Config Check : Are Benchmarks enabled
            if ($this->config['enabled']) {
                return $this->get($name);
            }
        }

        public function summary () {

            /**
             *They want a summary of all results
             */
            $results = [];

            $names = array_keys($this->marks);

            // Loop through all the benchmarks we have
            foreach ($names as $name)
            {
                $results[$name] = $this->get($name);

            }

            return $results;

        }

    }

