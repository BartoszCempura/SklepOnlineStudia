<?php
session_start(); // Make sure session is started
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session
// Redirect to 'logowanie' (this could be a URL or path to the login page)
header("Location: /SklepOnlineStudia/index.php?page=logowanie");

exit();
?>