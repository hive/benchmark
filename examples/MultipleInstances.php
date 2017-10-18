<?php

/**
 * Shows how to use multiple instances of the benchmark.
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use hive\benchmark;

// Start the benchmark
benchmark\instance::start('FirstBenchmark');

// Start a second benchmark
benchmark\instance::start('SecondBenchmark');

// Stop the second benchmark
benchmark\instance::stop('SecondBenchmark');

// Stop the benchmark
benchmark\instance::stop('FirstBenchmark');

// get the results of the benchmarks
print_r(benchmark\instance::get('FirstBenchmark'));
print_r(benchmark\instance::get('SecondBenchmark'));

