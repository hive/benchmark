<?php

/**
 * Simple example of using the benchmark object
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use hive\benchmark;

// Create the object
$benchmark = new benchmark\object();

// Start the benchmark
$benchmark->start('NameOfBenchmark');

// Stop the benchmark
$benchmark->stop('NameOfBenchmark');

// Output the benchmark
var_dump($benchmark->get('NameOfBenchmark'));
