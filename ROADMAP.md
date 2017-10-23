# Hive Benchmark
[![Latest Stable Version](https://poser.pugx.org/hive/benchmark/v/stable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![Latest Unstable Version](https://poser.pugx.org/hive/benchmark/v/unstable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![License](https://poser.pugx.org/hive/benchmark/license?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![composer.lock](https://poser.pugx.org/hive/benchmark/composerlock?format=flat-square)](https://packagist.org/packages/hive/benchmark)


Simple decoupled benchmark, Version 1.0 currently being developed

## Version 1.0.1.0

 ### Current
 * Add Benchmark/Trace Unit Tests. 
 * Add Exception/BadMethodCall Unit Tests. 

## Version 1.0.2.0

 * Add compare() which will compare two separate marks and give feedback
 * Add new 'timeline' output which will show the marks based on start/stop upon a time line, so you can easily see where time is being spent. 
 
## Version 1.0.3.0 

 * Travis_ci integration. 
 * Extract the output options from the benchmark code, however this should now break backwards compat.  

## Version 1.1.0.0

 * Update Instance to be an actual instance, and create new class for the singleton. 
 * Add a new class which references the instance but is a multiton pattern. 
 * Remove instance::method, as it is depreciated and replaced with the benchmark/trace(); 


## Version 2.0.0.0

 * Change minimum requirements for php to php 7.*, update code to reflect this change. 