<?php
// definiujemy ścieżki do template
$baseTemplate = __DIR__ . '/strona/templates/base.html'; 
$page = $_GET['page'] ?? 'home'; // default
$contentPath = __DIR__ . "/strona/templates/{$page}.php";

// sprawdzamy czy base template jest
if (file_exists($baseTemplate)) {
    
    $baseHtml = file_get_contents($baseTemplate);

    if (file_exists($contentPath)) {
        $contentHtml = file_get_contents($contentPath);
    } else {
        $contentHtml = '<h2>Page Not Found</h2>';
    }

    // podmieniamy blok {{ content }} na zawartość $page
    $finalOutput = str_replace('{{ content }}', $contentHtml, $baseHtml);

    // generujemy sumę
    echo $finalOutput;
} else {
    echo "Error: Base template not found.";
}
?>
