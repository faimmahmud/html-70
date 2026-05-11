<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/data.php';

$q = strtolower($_GET['q'] ?? '');
$result = array_values(array_filter($listings, function($item) use ($q) {
    if ($q === '') return true;
    return str_contains(strtolower($item['title']), $q) || str_contains(strtolower($item['location']), $q);
}));

echo json_encode([
    'success' => true,
    'count' => count($result),
    'data' => $result
], JSON_PRETTY_PRINT);
?>
