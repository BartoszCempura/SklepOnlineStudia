<?php

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define the base path to the root directory of the project (app folder)
define('BASE_PATH', __DIR__ );  // Goes up two levels from 'strona/include' to 'app/ folder'

// Include necessary files using BASE_PATH as the root directory for the project
require_once BASE_PATH . '/functions.php';  // Path to functions.php
require_once BASE_PATH . '/db.php';  // Path to db.php

?>
