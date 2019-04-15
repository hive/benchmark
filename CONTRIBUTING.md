## General

 * Every effort should be made to ensure that a package has no dependancies.
 * Code style should pass the Code Sniffer rules located at `build/phpcs.xml`
 * Code should pass the phpMD rules  : `codesize,controversial,design,naming,unusedcode`
 * Code style should pass the phpcpd standard rules

## Documentation
 * Code should be clean enough to not need comments
 * Code should always have comments and they should be so good that examples are not required
 * Code should always have examples and they should be so good that API documents are not required
 * Code should always have API documents.
 
## Structure 
 * Libraries are for extending not implementing
 * Objects are for implementing
 * Instances are static access
 * Interfaces and Abstract Classes are held with in the contracts folder
 * Facades are for allowing alias to access classes
 * Mixins folder is for holding all relavent traits
 * Helpers help drivers - drive main functions of a class
 * Exceptions folder is for holding specific exceptions
 * Drivers are for abstraction of the main function of a class

```php
//Where possible naming of the class should increase code reability ie. 
$mark = new hive\benchmark\instance(); 
benchmark\instance::start(); 
```

## General
 * Constructors do not process data, only assign. 
 * $config is purley for packages configruation not for data which will be parsed. 
 * $config is always set as a single array item, not paramters
 * Expcetion messages start generic and become more detail eg. The group field does not exist, Attempting to load a group which does not have a corresponding method with in the library.

## Methods
 * Resolve takes something (data) and returns an answer (information).
 * Parse is used for intneral calculations of a class and can be overriden.







 

