<h2 align="center">Ulubione</h2>
<?php
session_start();
require_once("./include/functions.php");

$content = "CONTENT"; // kod wykonany w przypakdu autoryzowanego usera

handleUser($content);

?>