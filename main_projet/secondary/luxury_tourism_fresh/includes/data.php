<?php
$featuredTours = json_decode(file_get_contents(__DIR__ . '/../data/packages.json'), true) ?: [];
$destinations = json_decode(file_get_contents(__DIR__ . '/../data/destinations.json'), true) ?: [];
$testimonials = json_decode(file_get_contents(__DIR__ . '/../data/testimonials.json'), true) ?: [];
$stats = json_decode(file_get_contents(__DIR__ . '/../data/stats.json'), true) ?: [];
$heroSlides = [
    [
        "title" => "Travel in a cinematic arc design",
        "subtitle" => "Luxury journeys, premium stays, and ultra-smooth storytelling sections.",
        "image" => "https://images.unsplash.com/photo-1519608487953-e999c86e7455?auto=format&fit=crop&w=1600&q=80"
    ],
    [
        "title" => "Where every view feels like a feature",
        "subtitle" => "Single-image layouts, strong hierarchy, and modern startup energy.",
        "image" => "https://images.unsplash.com/photo-1467269204594-9661b134dd2b?auto=format&fit=crop&w=1600&q=80"
    ],
    [
        "title" => "Built to look premium on every screen",
        "subtitle" => "White base, gold accents, glass panels, and subtle motion everywhere.",
        "image" => "https://images.unsplash.com/photo-1488085061387-422e29b40080?auto=format&fit=crop&w=1600&q=80"
    ],
];
?>