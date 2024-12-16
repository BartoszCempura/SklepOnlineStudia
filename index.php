<!-- template renderer -->
<?php

require_once __DIR__ . '/include/global.php';
// ścieżka do base.php
$baseTemplate = BASE_PATH . '/../strona/templates/base.php'; 

// default
$page = $_GET['page'] ?? 'home'; 

// pobiera ścieżke do wywoływanego pliku
$contentPath = BASE_PATH . "/../strona/templates/{$page}.php";

if (file_exists($baseTemplate)) {
    
    if (file_exists($contentPath)) {
        //uruchamiam buforowanie outputu aby złapać kontent skryptu php
        ob_start();
        
        include($contentPath);
        
        // Przypisuje treść skryptu
        $contentHtml = ob_get_clean();
    } else {
        $contentHtml = '<h2>Page Not Found</h2>';
    }

    // Buforowanie dla base.php
    ob_start();
    include($baseTemplate);
    $finalOutput = ob_get_clean();
    
    echo str_replace('{{ content }}', $contentHtml, $finalOutput);
} else {
    echo "Error: Base template not found.";
}
?>