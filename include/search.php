<?php
require_once __DIR__ . '/global.php';

$searchInput = trim(filter_var($_POST['searchInput'], FILTER_SANITIZE_SPECIAL_CHARS));

//$products = searchProducts($site_conn, $searchInput);
header("Location: /SklepOnlineStudia/sklep?input=$searchInput");
?>