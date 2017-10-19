<?php

/**
 * Simple example of using the benchmark instance
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

$bm = new \Hive\Benchmark\Object(['enabled' => false]);
$bm->start('test');
$bm->stop('test');
$result = $bm->summary();



var_dump($result);

die();
Hive\Benchmark\Instance::config(['enabled' => false]);
Hive\Benchmark\Instance::start('test');
Hive\Benchmark\Instance::stop('test');

Hive\Benchmark\Instance::config(['enabled' => true]);
Hive\Benchmark\Instance::start('test2');
Hive\Benchmark\Instance::stop('test2');

var_dump(Hive\Benchmark\Instance::summary());
die();
// Use the benchmark
use Hive\Benchmark;

$bm = new \Hive\Benchmark\Object(['enabled' => false]);
$bm->start('test');
$bm->stop('test');
$bm->start('test');
$bm->stop('test');
$result = $bm->details('test');
var_dump($result);
die();
print_r(Benchmark\Instance::get('NameOfBenchmark'));

die();
// Start the benchmark
Benchmark\Instance::start('NameOfBenchmark');

// Stop the benchmark
Benchmark\Instance::stop('NameOfBenchmark');

// Output the benchmark
print_r(Benchmark\Instance::get('NameOfBenchmark'));
