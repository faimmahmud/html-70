<?php
require_once __DIR__ . '/../includes/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
$filters = [
  'q' => trim((string)($_GET['q'] ?? '')),
  'city' => trim((string)($_GET['city'] ?? '')),
  'listing_type' => trim((string)($_GET['listing_type'] ?? '')),
  'status' => trim((string)($_GET['status'] ?? '')),
  'type' => trim((string)($_GET['type'] ?? '')),
  'min_price' => trim((string)($_GET['min_price'] ?? '')),
  'max_price' => trim((string)($_GET['max_price'] ?? '')),
  'bedrooms' => trim((string)($_GET['bedrooms'] ?? '')),
];
echo json_encode(['success' => true, 'data' => get_properties($filters)], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
