<?php

$servername = "localhost";
$username = "root";
$password = "";
$clientDB_name = "clientDB";
$siteDB_name = "siteDB";

$client_conn = new mysqli($servername, $username, $password, $clientDB_name);
if ($client_conn->connect_error) {
    die("Error occured connecting to '$clientDB_name': " . $conn1->connect_error);
}

$site_conn = new mysqli($servername, $username, $password, $siteDB_name);
if ($site_conn->connect_error) {
    die("Error occured connecting to '$siteDB_name': " . $conn2->connect_error);
}

$conn->close();
?>
