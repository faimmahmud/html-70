<?php
$siteName = 'Fly Soul';
$siteTagline = 'Discover the world in style.';

$destinations = [
    [
        'name' => 'Dubai',
        'country' => 'United Arab Emirates',
        'price' => 64544,
        'badge' => 'Popular',
        'image' => 'assets/img/dubai.jpg',
        'region' => 'Middle East',
    ],
    [
        'name' => 'London',
        'country' => 'United Kingdom',
        'price' => 137201,
        'badge' => 'Classic',
        'image' => 'assets/img/london.jpg',
        'region' => 'Europe',
    ],
    [
        'name' => 'Bangkok',
        'country' => 'Thailand',
        'price' => 45320,
        'badge' => 'Top deal',
        'image' => 'assets/img/bangkok.jpg',
        'region' => 'Asia',
    ],
    [
        'name' => 'Istanbul',
        'country' => 'Turkey',
        'price' => 62330,
        'badge' => 'Historic',
        'image' => 'assets/img/istanbul.jpg',
        'region' => 'Asia/Europe',
    ],
    [
        'name' => 'Singapore',
        'country' => 'Singapore',
        'price' => 58420,
        'badge' => 'Modern',
        'image' => 'assets/img/singapore.jpg',
        'region' => 'Asia',
    ],
];

$services = [
    [
        'type' => 'hotels',
        'title' => 'Hotels',
        'subtitle' => 'Find the perfect stay',
        'icon' => '🏨',
        'short' => 'Compare comfort, location, and value.',
    ],
    [
        'type' => 'car-rentals',
        'title' => 'Car rentals',
        'subtitle' => 'Explore your options',
        'icon' => '🚗',
        'short' => 'Choose city rides, SUVs, or premium cars.',
    ],
    [
        'type' => 'tours',
        'title' => 'Tours & activities',
        'subtitle' => 'Explore experiences',
        'icon' => '🎫',
        'short' => 'Book city tours, day trips, and adventures.',
    ],
    [
        'type' => 'chauffeur',
        'title' => 'Chauffeur-drive',
        'subtitle' => 'Comfort at your door',
        'icon' => '🧑‍✈️',
        'short' => 'Private transfer for airport and city travel.',
    ],
    [
        'type' => 'meet-greet',
        'title' => 'Meet & Greet',
        'subtitle' => 'Assistance at airport',
        'icon' => '🤝',
        'short' => 'Smooth arrival support and escort service.',
    ],
    [
        'type' => 'transfers',
        'title' => 'Airport transfers',
        'subtitle' => 'Hassle-free transfers',
        'icon' => '🚌',
        'short' => 'Door-to-door pickup with easy booking.',
    ],
];

$servicePackages = [
    'hotels' => [
        ['title' => 'City Comfort Stay', 'price' => 45, 'desc' => 'Comfortable rooms close to major landmarks.'],
        ['title' => 'Premium Suite', 'price' => 90, 'desc' => 'More space, better views, and quiet luxury.'],
        ['title' => 'Family Hotel Deal', 'price' => 70, 'desc' => 'A smart option for families and longer stays.'],
    ],
    'car-rentals' => [
        ['title' => 'Airport Pickup', 'price' => 30, 'desc' => 'Private pickup for a smooth arrival.'],
        ['title' => 'Hourly Chauffeur', 'price' => 60, 'desc' => 'Hire a driver by the hour.'],
        ['title' => 'Full Day Car', 'price' => 120, 'desc' => 'Best for flexible city travel.'],
    ],
    'tours' => [
        ['title' => 'City Highlights Tour', 'price' => 25, 'desc' => 'See the city’s best-known sights.'],
        ['title' => 'Adventure Day Trip', 'price' => 55, 'desc' => 'Active travel with guided support.'],
        ['title' => 'Sunset Experience', 'price' => 40, 'desc' => 'A relaxing option for couples and groups.'],
    ],
    'chauffeur' => [
        ['title' => 'Airport Pickup', 'price' => 30, 'desc' => 'Meet your driver right at arrival.'],
        ['title' => 'Hourly Chauffeur', 'price' => 60, 'desc' => 'Flexible private ride service.'],
        ['title' => 'Full Day Car', 'price' => 120, 'desc' => 'Travel the city your way.'],
    ],
    'meet-greet' => [
        ['title' => 'Fast Track Arrival', 'price' => 20, 'desc' => 'Extra help from landing to exit.'],
        ['title' => 'VIP Help Desk', 'price' => 35, 'desc' => 'Priority guidance at the airport.'],
        ['title' => 'Family Assistance', 'price' => 25, 'desc' => 'Support for children and groups.'],
    ],
    'transfers' => [
        ['title' => 'Hotel Transfer', 'price' => 18, 'desc' => 'Easy ride from airport to hotel.'],
        ['title' => 'Private Sedan', 'price' => 28, 'desc' => 'A comfortable private car service.'],
        ['title' => 'Van Transfer', 'price' => 42, 'desc' => 'Great for families and luggage.'],
    ],
];

$offers = [
    ['title' => 'Europe Special', 'tag' => 'Up to 20% off', 'image' => 'assets/img/europe-special.jpg', 'text' => 'Travel until 30 Jun 2025'],
    ['title' => 'Middle East Escape', 'tag' => 'Up to 15% off', 'image' => 'assets/img/middle-east.jpg', 'text' => 'Travel until 31 Aug 2025'],
    ['title' => 'Asia Discovery', 'tag' => 'Up to 25% off', 'image' => 'assets/img/asia-discovery.jpg', 'text' => 'Travel until 30 Sep 2025'],
    ['title' => 'America Explorer', 'tag' => 'Up to 10% off', 'image' => 'assets/img/america-explorer.jpg', 'text' => 'Travel until 31 Aug 2025'],
];

$testimonials = [
    [
        'name' => 'Rahim Hasan',
        'role' => 'Traveler',
        'text' => 'Booking with Fly Soul is smooth and reliable. Great deals and amazing support.',
        'image' => 'assets/img/avatar.jpg',
    ],
];

$blogPosts = [
    ['title' => 'Best time to book international flights', 'slug' => 'best-time-to-book'],
    ['title' => 'How to choose the right travel package', 'slug' => 'choose-package'],
    ['title' => 'Top destinations for a premium holiday', 'slug' => 'top-destinations'],
];

$paymentMethods = [
    ['value' => 'card', 'label' => 'Credit / Debit Card'],
    ['value' => 'bkash', 'label' => 'bKash'],
    ['value' => 'nagad', 'label' => 'Nagad'],
    ['value' => 'rocket', 'label' => 'Rocket'],
    ['value' => 'paypal', 'label' => 'PayPal'],
    ['value' => 'bank', 'label' => 'Bank Transfer'],
    ['value' => 'apple_google', 'label' => 'Apple Pay / Google Pay'],
];
