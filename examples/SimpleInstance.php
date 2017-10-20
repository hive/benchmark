<?php

/**
 * Simple example of using the benchmark instance
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the usage.
use \Hive\Benchmark;

// Start the benchmark
Benchmark\Instance::start('NameOfBenchmark');

// Stop the benchmark
Benchmark\Instance::stop('NameOfBenchmark');

// Output the benchmark
print_r(Benchmark\Instance::get('NameOfBenchmark'));
