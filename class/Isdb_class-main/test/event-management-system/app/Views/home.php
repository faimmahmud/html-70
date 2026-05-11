<?php ob_start(); ?>

<nav id="premiumNav" class="navbar navbar-expand-lg fixed-top navbar-dark px-3 px-md-4 py-3 glass-nav">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold tracking-wide text-white" href="/">
            VVIP Events
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item"><a class="nav-link text-white-50" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link text-white-50" href="#events">Events</a></li>
                <li class="nav-item"><a class="nav-link text-white-50" href="#security">Security</a></li>
                <li class="nav-item">
                    <a class="btn btn-light rounded-pill px-4 fw-semibold" href="/register">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="hero-shell d-flex align-items-center">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <div class="container position-relative hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7 reveal">
                <span class="badge rounded-pill text-bg-warning px-3 py-2 mb-4">
                    Premium Event Management Platform
                </span>
                <h1 class="display-3 fw-bold lh-1 mb-4">
                    Luxury-grade event experiences, managed with precision.
                </h1>
                <p class="lead text-white-75 mb-4 max-w-2xl">
                    Plan conferences, concerts, private gatherings, and enterprise events with a polished system built for scale, speed, and trust.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/register" class="btn btn-warning btn-lg rounded-pill px-4 fw-semibold">Get Started</a>
                    <a href="#features" class="btn btn-outline-light btn-lg rounded-pill px-4">Explore Features</a>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="features" class="py-5 py-lg-6 bg-gradient-soft">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <div class="premium-card h-100">
                    <h3 class="h4">Smart Event Control</h3>
                    <p class="text-white-75 mb-0">Create, publish, and manage events with clean administrative workflows and structured data.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="premium-card h-100">
                    <h3 class="h4">Ticket Intelligence</h3>
                    <p class="text-white-75 mb-0">Track registrations, ticket issuance, and attendance with a secure, searchable backend.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="premium-card h-100">
                    <h3 class="h4">Premium Presentation</h3>
                    <p class="text-white-75 mb-0">Luxury-inspired motion, refined spacing, and polished typography for a high-end brand feel.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="events" class="py-5 py-lg-6">
    <div class="container">
        <div class="row align-items-end mb-4">
            <div class="col-lg-8 reveal">
                <h2 class="display-6 fw-bold">Designed for high-value event operations.</h2>
                <p class="text-white-75 mb-0">From small private events to large-scale experiences, the system stays organized and responsive.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6 reveal">
                <div class="event-showcase event-showcase-one">
                    <div class="event-meta">Corporate Summit</div>
                    <h3>Executive-level event handling</h3>
                    <p>Ideal for premium conferences, launches, and brand activations.</p>
                </div>
            </div>
            <div class="col-lg-6 reveal">
                <div class="event-showcase event-showcase-two">
                    <div class="event-meta">Gala Night</div>
                    <h3>Elegant guest experience flow</h3>
                    <p>Responsive design, smooth motion, and frictionless registration.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="security" class="py-5 py-lg-6 bg-gradient-soft">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6 reveal">
                <div class="premium-card">
                    <h2 class="h1 fw-bold">Security first.</h2>
                    <p class="text-white-75 mb-0">Password hashing, CSRF protection, prepared statements, and server-side validation are already built in.</p>
                </div>
            </div>
            <div class="col-lg-6 reveal">
                <div class="premium-card">
                    <h2 class="h1 fw-bold">Built to extend.</h2>
                    <p class="text-white-75 mb-0">Add login, admin panels, ticketing, QR validation, payments, and event dashboards without rewriting the foundation.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
