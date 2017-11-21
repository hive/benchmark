<?php

/**
 * Shows how to use multiple instances of the benchmark.
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use Hive\Benchmark;

// Start the benchmark
Benchmark\Instance::start('FirstBenchmark');

// Start a second benchmark
Benchmark\Instance::start('SecondBenchmark');

// Stop the second benchmark
Benchmark\Instance::stop('SecondBenchmark');

// Stop the benchmark
Benchmark\Instance::stop('FirstBenchmark');

// get the results of the benchmarks
print_r(Benchmark\Instance::get('FirstBenchmark'));
print_r(Benchmark\Instance::get('SecondBenchmark'));

