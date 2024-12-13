<h2 align="center">Twoje Konto</h2>
<?php
session_start();
require_once("./include/functions.php");

$content = "CONTENT"; // kod wykonany w przypakdu autoryzowanego usera
handleUser($content);

?>

<form action="./include/logout.php">
    <button type="submit">logout</button>
</form>