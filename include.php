<?php
    /**
     * Simple include file for the library, so it can be used
     * easily with out composer.
     */

    // Include the contracts
    include 'Source/Contract/Library.php';
    include 'Source/Contract/Object.php';
    include 'Source/Contract/Instance.php';

    // Include the source files
    include 'Source/Library.php';
    include 'Source/Object.php';
    include 'Source/Instance.php';

    // Include the exceptions
    include 'Source/Exception.php';
    include 'Source/Exception/AlreadyRunning.php';
    include 'Source/Exception/NotRunning.php';
    include 'Source/Exception/StoppedRunning.php';
    include 'Source/Exception/DoesNotExist.php';
