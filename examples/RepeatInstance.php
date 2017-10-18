<?php

/**
 * Shows how to us the benchmark instance, for multiple calls and nested calls
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use Hive\Benchmark;

// Start the benchmark
Benchmark\Instance::start('FirstBenchmark');

for ($i=rand(1,100); $i>0; $i--) {

    // Start another benchmark
    Benchmark\Instance::start('SubBenchmark');

    // Do Some Actions

    // Stop the other benchmark
    Benchmark\Instance::stop('SubBenchmark');
}

// Stop the benchmark
Benchmark\Instance::stop('FirstBenchmark');

// Get a summary of all benchmarks
print_r(Benchmark\Instance::summary());
