<?php

/**
 * Simple example of using the benchmark instance
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use hive\benchmark;

// Start the benchmark
benchmark/instance::start('NameOfBenchmark');

// Stop the benchmark
benchmark/instance::stop('NameOfBenchmark');

// Output the benchmark
print_r(benchmark\instance::get('SecondBenchmark'));