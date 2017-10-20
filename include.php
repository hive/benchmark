<?php
    /**
     * Simple include file for the library, so it can be used
     * easily with out composer.
     */

    // Include the contracts
    include 'source/Contract/Library.php';
    include 'source/Contract/Object.php';
    include 'source/Contract/Instance.php';

    // Include the source files
    include 'source/Library.php';
    include 'source/Object.php';
    include 'source/Instance.php';

    //Include Facades
    include 'source/Facade/Trace.php';

    // Include the exceptions
    include 'source/Exception.php';
    include 'source/Exception/NotRunning.php';
    include 'source/Exception/StoppedRunning.php';
    include 'source/Exception/DoesNotExist.php';
    include 'source/Exception/AlreadyInitiated.php';
    include 'source/Exception/BadMethodCall.php';
