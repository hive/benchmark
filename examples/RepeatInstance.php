<?php

/**
 * Shows how to us the benchmark instance, for multiple calls and nested calls
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use hive\benchmark;

// Start the benchmark
benchmark\instance::start('FirstBenchmark');

for ($i=rand(1,100); $i>0; $i--) {

    // Start another benchmark
    benchmark\instance::start('SubBenchmark');

    // Do Some Actions

    // Stop the other benchmark
    benchmark\instance::stop('SubBenchmark');
}

// Stop the benchmark
benchmark\instance::stop('FirstBenchmark');

// Get a summary of all benchmarks
print_r(benchmark\instance::summary());
