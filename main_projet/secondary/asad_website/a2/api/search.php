<?php
require_once __DIR__ . '/../includes/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
$q = trim((string)($_GET['q'] ?? ''));
$list = get_properties(['q' => $q]);
$out = array_map(function ($p) {
    return [
        'id' => $p['id'],
        'slug' => $p['slug'],
        'title' => $p['title'],
        'city' => $p['city'],
        'price' => $p['price'],
        'image' => $p['image'],
        'listing_type' => $p['listing_type'],
    ];
}, array_slice($list, 0, 10));
echo json_encode(['success' => true, 'count' => count($out), 'data' => $out], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
