<?php

/**
 * Simple example of using the benchmark object
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use Hive\Benchmark;

// Create the object
$benchmark = new Benchmark\Object();

// Start the benchmark
$benchmark->start('NameOfBenchmark');

// Stop the benchmark
$benchmark->stop('NameOfBenchmark');

// Output the benchmark
var_dump($benchmark->get('NameOfBenchmark'));
