<?php namespace Hive\Benchmark;

/**
 * Benchmark Library
 *
 * The actual benchmark library, which does the core operations
 *
 * @author Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 * @copyright (c) 2016 Jamie Peake
 *
 * @package Hive
 * @subpackage Benchmark
 */
class Library implements Contract\Library
{

    /**
     * Default configuration settings
     *
     * config['enabled'] array Defines the feilds to be shown by scaffolding.
     * config['memory'] array Defines the feilds to be shown by scaffolding.
     * config['enabled'] array Defines the feilds to be shown by scaffolding.
     *
     * @var array ['enabled'] : boolean : Whether or not the benchmark is enabled, set to false if you wish to disabled on production
     * @var array ['memory'] : boolean : Whether or not to benchmark memory useage, uses memory_get_usage()
     * @var array ['decimals'] : integer : The number of decimals to benchmark against
     *
     */
    private $config = [

        'enabled'  => true,
        'memory'   => true,
        'decimals' => 9
    ];

    /**
     * Internal storage for benchmarks
     *
     * @var array
     */
    public $marks = [];


    /**
     * Library constructor.
     *
     * @param array $config
     *
     * @throws Exception\RequiresMemoryGetUsage
     */
    public function __construct(array $config = [])
    {

        // Merge the config with the defaults
        $this->config = array_merge($config, $this->config);

        // sanity check upon memory
        if ($this->config['memory']) {

            // if enabled ensure we can get it
            if (!function_exists('memory_get_usage')) {

                throw new Exception\RequiresMemoryGetUsage();

            }
        }

    }

    /**
     * Start a benchmark
     *
     * @param $name string benchmark name
     *
     * @return void
     */
    public function start($name)
    {
        /*
         * Only run if the library is enabled, this allows us to disable
         * the benchmark by config for production servers.
         */
        if ($this->config['enabled']) {


            // create the parent holder
            if (!isset($this->marks[$name])) {
                $this->marks[$name] = [];
            }

            // set the timer benchmark
            $mark['timer'] = ['start' => microtime(true), 'stop' => false];

            // If the memory benchmark is enabled
            if ($this->config['memory']) {

                $mark['memory'] = ['start' => memory_get_usage(), 'stop' => false];
            }

            // Add the item to the top of its array
            array_unshift($this->marks[$name], $mark);
        }

    }

    /**
     * Stop a benchmark
     *
     * @param $name string benchmark name
     *
     * @throws \Hive\Benchmark\Exception\FinishedRunning
     * @throws \Hive\Benchmark\Exception\NotRunning
     *
     * @return void
     */
    public function stop($name)
    {
        // Config Check : Are Benchmarks enabled
        if ($this->config['enabled']) {

            // ensure that the benchmark we are attempting to stop has been started
            if (isset($this->marks[$name])) {

                // ensure that it hasnt already been stopped
                if ($this->marks[$name][0]['timer']['stop'] === false) {

                    $this->marks[$name][0]['timer']['stop'] = microtime(true);

                    // If the memory benchmark is enabled
                    if ($this->config['memory']) {

                        $this->marks[$name][0]['memory']['stop'] = memory_get_usage();

                    }

                } else {

                    throw new Exception\FinishedRunning($name);
                }


            } else {

                throw new Exception\NotRunning($name);

            }

        }
    }

    
    /**
     * Get a benchmark
     *
     * @param $name string|boolean the name of the benchmark to get or get all (true)
     *
     * @return array|bool Either an array of requested marks or false on fail
     *
     * @throws \Hive\Benchmark\Exception
     * @throws \Hive\Benchmark\Exception\FinishedRunning
     * @throws \Hive\Benchmark\Exception\NotRunning
     */
    public function get($name = false)
    {
        $result = false;

        // Config Check : Are Benchmarks enabled
        if ($this->config['enabled']) {

            if ($name) {
                
                if (isset($this->marks[$name])) {
    
                    // Auto stop any running benchmarks in-case of error
                    if ($this->marks[$name][0]['timer']['stop'] === false) {
    
                        $this->stop($name);
                    }
                    
                } else {
                    
                    throw new Exception\NotRunning($name);
                
                }

                $result = $this->retrieve($name);

            } else {

                // No name entered, they want all results

                $result = [];

                $names = array_keys($this->marks);

                // Loop through all the benchmarks we have
                foreach ($names as $name) {

                    $result[$name] = $this->retrieve($name);

                }

            }
        }

        return $result;

    }

    /**
     * Retrieve an item from the internal marks storage array
     *
     * Internal process, no gigo/sanity/exceptions
     *
     * @param $name
     *
     * @throws \Hive\Benchmark\Exception
     *
     * @return array
     */
    private function retrieve ($name) {

        try {

            // Return the time between the start and stop points
            // Properly reading a float requires using number_format or sprintf
            $time = $memory = 0;
            for ($i = 0; $i < count($this->marks[$name]); $i++) {

                $time += $this->marks[$name][$i]['timer']['stop'] - $this->marks[$name][$i]['timer']['start'];

                // Config Check : Are memory benchmarks enabled
                if ($this->config['memory']) {

                    $memory += $this->marks[$name][$i]['memory']['stop'] - $this->marks[$name][$i]['memory']['start'];

                }
            }

            $result = [
                'time'   => number_format($time, $this->config['decimals']),
                'count'  => count($this->marks[$name])
            ];

            // If memory has been assigned
            if ($memory) {
                $result['memory'] = $memory;
            }

        } catch (\Exception $e) {

            throw new Exception($e->getMessage(), $e->getCode());

        }

        return $result;

    }


}

