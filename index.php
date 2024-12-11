<?php
// ścieżka do base.html
$baseTemplate = __DIR__ . '/strona/templates/base.html'; 

// default
$page = $_GET['page'] ?? 'home'; 

//pobiera ścieżke do wywoływanego pliku
$contentPath = __DIR__ . "/strona/templates/{$page}.php";

if (file_exists($baseTemplate)) {
    
    $baseHtml = file_get_contents($baseTemplate);

    if (file_exists($contentPath)) {
        //uruchamiam buforowanie outputu aby złapać kontent skryptu php
        ob_start();
        
        include($contentPath);
        
        // przypisuje treśc skryptu
        $contentHtml = ob_get_clean();
    } else {
        $contentHtml = '<h2>Page Not Found</h2>';
    }

    $finalOutput = str_replace('{{ content }}', $contentHtml, $baseHtml);
    
    echo $finalOutput;
} else {
    echo "Error: Base template not found.";
}
?>
