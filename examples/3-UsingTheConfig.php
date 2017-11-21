<?php
/**
 * The benchmark library has several configuration options, which can be set either on the object
 * or against the instance.
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use Hive\Benchmark;

$config = [
    'enabled'   => true,    // whether or not the benchmark is enabled.
    'time'     => true,    // whether or not to benchmark time.
    'memory'    => true,    // whether or not to benchmark memory.
    'decimals' => 8        // number of decimal points to report on
];

// disabling benchmarking on production servers is easy
$config['enabled'] = (IN_DEVELOPMENT || IN_STAGING);

$bench = new Benchmark\Object($config);
