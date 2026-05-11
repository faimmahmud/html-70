<?php
require_once __DIR__ . '/../config/config.php';

function site_title(string $title = ''): string
{
    return $title ? $title . ' | ' . SITE_NAME : SITE_NAME;
}

function get_destinations(): array
{
    return [
        ['id' => 1, 'name' => 'Paris, France', 'type' => 'City Escape', 'price' => 'From $1,120', 'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1200&q=80'],
        ['id' => 2, 'name' => 'Dubai, UAE', 'type' => 'Luxury Journey', 'price' => 'From $980', 'image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&q=80'],
        ['id' => 3, 'name' => 'Bali, Indonesia', 'type' => 'Island Retreat', 'price' => 'From $760', 'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80'],
        ['id' => 4, 'name' => 'Swiss Alps', 'type' => 'Mountain Luxury', 'price' => 'From $1,450', 'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80'],
    ];
}

function get_tours(): array
{
    return [
        ['id' => 101, 'title' => 'Grand Europe Highlights', 'duration' => '12 Days', 'rating' => '4.9', 'price' => '$2,450', 'desc' => 'A premium route through iconic cities, architecture, and culture.'],
        ['id' => 102, 'title' => 'Luxury Middle East Experience', 'duration' => '8 Days', 'rating' => '4.8', 'price' => '$1,980', 'desc' => 'Modern skylines, desert adventures, and five-star hospitality.'],
        ['id' => 103, 'title' => 'Tropical Escape', 'duration' => '7 Days', 'rating' => '4.9', 'price' => '$1,120', 'desc' => 'Relaxed beaches, island views, and unforgettable sunsets.'],
        ['id' => 104, 'title' => 'World Heritage Journey', 'duration' => '10 Days', 'rating' => '5.0', 'price' => '$2,100', 'desc' => 'A curated cultural trip across historic landmarks.'],
    ];
}

function get_tour_by_id($id): ?array
{
    foreach (get_tours() as $tour) {
        if ((string)$tour['id'] === (string)$id) {
            return $tour;
        }
    }
    return null;
}

function get_blog_posts(): array
{
    return [
        ['title' => 'How to plan a premium world tour', 'date' => 'May 2026', 'excerpt' => 'Smart timing, route planning, and traveler comfort for a better trip.'],
        ['title' => 'Top places for international travelers', 'date' => 'May 2026', 'excerpt' => 'A curated list of destinations for every travel style.'],
        ['title' => 'Why user-friendly booking matters', 'date' => 'May 2026', 'excerpt' => 'Simple navigation and clear pricing help customers book faster.'],
    ];
}

function esc(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
