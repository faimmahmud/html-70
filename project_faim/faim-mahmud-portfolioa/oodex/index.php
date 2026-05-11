<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'faim mahmud | Luxury Web Developer Portfolio';
$pageDescription = 'Premium portfolio of faim mahmud, a professional web developer building refined HTML, CSS, Bootstrap, JavaScript, jQuery, PHP, and MySQL experiences.';
$activePage = 'home';

require __DIR__ . '/includes/header.php';
?>

<main id="main" class="page-shell">
    <section id="top" class="hero-section" aria-labelledby="hero-title">
        <div class="scroll-progress" data-scroll-progress aria-hidden="true"></div>
        <div class="container-fluid px-3 px-lg-5">
            <div class="hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow reveal">Independent web developer for serious digital presence</p>
                    <h1 id="hero-title" class="hero-title reveal">
                        I build web experiences that feel rare before they say a word.
                    </h1>
                    <p class="hero-lede reveal">
                        I am faim mahmud, a professional web developer crafting polished front-end interfaces and dependable PHP/MySQL systems for brands that want trust, speed, and a premium first impression.
                    </p>
                    <div class="hero-actions reveal">
                        <a class="btn-luxury magnetic" href="#work">View selected work</a>
                        <a class="btn-ghost magnetic" href="#contact">Start a private brief</a>
                    </div>
                    <div class="hero-proof reveal" aria-label="Core capabilities">
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>Bootstrap 5</span>
                        <span>JavaScript</span>
                        <span>jQuery</span>
                        <span>PHP</span>
                        <span>MySQL</span>
                    </div>
                </div>

                <div class="hero-visual reveal" aria-label="Premium portfolio visual">
                    <div class="signature-card tilt-card">
                        <img src="<?= e(asset('images/royaltexture.webp')); ?>" alt="" aria-hidden="true">
                        <div class="signature-overlay">
                            <span class="sig-index">FM / 01</span>
                            <h2>Digital presence engineered with taste.</h2>
                            <p>Interface, motion, backend reliability, and conversion strategy working as one system.</p>
                        </div>
                    </div>
                    <div class="metric-orbit metric-one">
                        <strong>7</strong>
                        <span>core technologies</span>
                    </div>
                    <div class="metric-orbit metric-two">
                        <strong>24h</strong>
                        <span>lead-ready contact flow</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="identity" class="section-block identity-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Strategic identity</span>
                <span>01</span>
            </div>
            <div class="split-grid">
                <div>
                    <h2 class="section-title reveal">Not just a developer. A builder of first impressions.</h2>
                </div>
                <div class="section-copy reveal">
                    <p>
                        Most portfolio websites try to prove skill with noise. This one does the opposite. It uses restraint, speed, spacing, motion, and precise messaging to create the feeling clients actually buy: confidence.
                    </p>
                    <p>
                        My work sits where front-end polish meets practical backend systems. I build interfaces that feel premium and code paths that are simple enough to maintain after the launch moment is over.
                    </p>
                </div>
            </div>

            <div class="principle-grid">
                <article class="principle-card reveal">
                    <span>01</span>
                    <h3>Presence before decoration</h3>
                    <p>Every visual choice must make the brand feel sharper, more trusted, or easier to act on.</p>
                </article>
                <article class="principle-card reveal">
                    <span>02</span>
                    <h3>Motion with discipline</h3>
                    <p>Animations guide attention. They do not interrupt the user or hide weak structure.</p>
                </article>
                <article class="principle-card reveal">
                    <span>03</span>
                    <h3>Systems over pages</h3>
                    <p>Forms, data, copy, layout, and performance are designed as one conversion system.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block skills-section" aria-labelledby="skills-title">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Technical stack</span>
                <span>02</span>
            </div>
            <h2 id="skills-title" class="section-title reveal">A focused stack for polished, practical websites.</h2>
            <div class="skill-marquee reveal" aria-label="Skills">
                <div class="skill-track">
                    <span>HTML5</span>
                    <span>CSS3</span>
                    <span>Bootstrap 5</span>
                    <span>JavaScript</span>
                    <span>jQuery</span>
                    <span>PHP</span>
                    <span>MySQL</span>
                    <span>Responsive UI</span>
                    <span>Contact Systems</span>
                    <span>SEO Basics</span>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="section-block services-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Signature services</span>
                <span>03</span>
            </div>
            <div class="service-grid">
                <article class="service-panel reveal">
                    <div class="service-number">01</div>
                    <h3>Luxury portfolio systems</h3>
                    <p>Personal-brand websites with elevated design, sharp copy, cinematic motion, and lead capture built into the foundation.</p>
                </article>
                <article class="service-panel reveal">
                    <div class="service-number">02</div>
                    <h3>Business websites that convert</h3>
                    <p>Responsive websites for agencies, consultants, service brands, and local businesses that need credibility fast.</p>
                </article>
                <article class="service-panel reveal">
                    <div class="service-number">03</div>
                    <h3>PHP and MySQL workflows</h3>
                    <p>Contact forms, booking logic, dashboards, database-backed content, and clean admin-ready foundations.</p>
                </article>
                <article class="service-panel reveal">
                    <div class="service-number">04</div>
                    <h3>Front-end refinement</h3>
                    <p>Performance, responsive details, hover states, animation timing, accessibility, and polish that makes a site feel expensive.</p>
                </article>
            </div>
        </div>
    </section>

    <section id="work" class="section-block work-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Selected work direction</span>
                <span>04</span>
            </div>
            <div class="split-grid align-items-end">
                <h2 class="section-title reveal">Case studies designed to show judgment, not just screens.</h2>
                <p class="section-copy reveal">
                    These are premium placeholder case studies written to position the work correctly. Replace them with real metrics and screenshots when the final project archive is ready.
                </p>
            </div>

            <div class="case-grid">
                <article class="case-card reveal tilt-card">
                    <span class="case-label">Travel platform</span>
                    <h3>Royal Atlas Experience</h3>
                    <p>A cinematic travel interface concept with destination browsing, booking logic, admin-ready data, and luxury visual texture.</p>
                    <div class="case-tags">
                        <span>PHP</span>
                        <span>jQuery</span>
                        <span>MySQL-ready</span>
                    </div>
                </article>
                <article class="case-card reveal tilt-card featured-case">
                    <span class="case-label">Private brand</span>
                    <h3>Founder Presence System</h3>
                    <p>A premium one-page identity system for an executive profile: editorial copy, conversion sections, and restrained motion design.</p>
                    <div class="case-tags">
                        <span>Bootstrap 5</span>
                        <span>Motion</span>
                        <span>SEO</span>
                    </div>
                </article>
                <article class="case-card reveal tilt-card">
                    <span class="case-label">Lead engine</span>
                    <h3>Client Brief Pipeline</h3>
                    <p>A secure contact workflow with validation, database storage, source tracking, and a structure ready for future admin review.</p>
                    <div class="case-tags">
                        <span>PDO</span>
                        <span>Validation</span>
                        <span>MySQL</span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section id="process" class="section-block process-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Execution system</span>
                <span>05</span>
            </div>
            <div class="process-board reveal">
                <div class="process-copy">
                    <h2>How I turn an idea into a website people trust.</h2>
                    <p>I treat a website like a reputation system. The first screen creates belief, the middle proves judgment, and the final action makes contact easy.</p>
                </div>
                <div class="process-steps">
                    <div>
                        <span>01</span>
                        <strong>Diagnose</strong>
                        <p>Clarify the audience, offer, credibility gap, and highest-value action.</p>
                    </div>
                    <div>
                        <span>02</span>
                        <strong>Design</strong>
                        <p>Create the page rhythm, visual tone, motion language, and conversion sections.</p>
                    </div>
                    <div>
                        <span>03</span>
                        <strong>Develop</strong>
                        <p>Build clean responsive front-end code with practical PHP/MySQL functionality.</p>
                    </div>
                    <div>
                        <span>04</span>
                        <strong>Refine</strong>
                        <p>Test responsiveness, speed, accessibility, form behavior, and final presentation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block proof-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="proof-grid">
                <div class="quote-card reveal">
                    <p class="quote-mark">"</p>
                    <blockquote>
                        The best developer portfolios do not beg for attention. They make competence obvious, then make the next step effortless.
                    </blockquote>
                    <span>Creative standard for this build</span>
                </div>
                <div class="proof-stats">
                    <div class="stat reveal">
                        <strong>Fast</strong>
                        <span>Local assets, focused scripts, performance-first animation.</span>
                    </div>
                    <div class="stat reveal">
                        <strong>Serious</strong>
                        <span>Real PHP endpoint, MySQL storage, prepared statements.</span>
                    </div>
                    <div class="stat reveal">
                        <strong>Premium</strong>
                        <span>Luxury texture, editorial copy, restrained motion.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section-block contact-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="contact-shell">
                <div class="contact-copy reveal">
                    <p class="eyebrow">Private brief</p>
                    <h2>Bring the idea. I will shape the digital presence.</h2>
                    <p>
                        Tell me what you are building, what the website needs to make people believe, and where the current version falls short.
                    </p>
                    <div class="contact-details">
                        <a href="mailto:<?= e(SITE_EMAIL); ?>"><?= e(SITE_EMAIL); ?></a>
                        <span>Available for portfolio, business website, and PHP/MySQL builds.</span>
                    </div>
                </div>

                <form class="brief-form reveal" id="briefForm" action="api/contact.php" method="post" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>">
                    <input type="hidden" name="source_page" value="portfolio-home">

                    <div class="form-status" data-form-status role="status" aria-live="polite"></div>

                    <div class="form-row">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" autocomplete="name" placeholder="Your name" required>
                        <span class="field-error" data-error-for="name"></span>
                    </div>

                    <div class="form-row">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com" required>
                        <span class="field-error" data-error-for="email"></span>
                    </div>

                    <div class="form-row">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel" autocomplete="tel" placeholder="Optional">
                    </div>

                    <div class="form-row two-col">
                        <div>
                            <label for="service">Service</label>
                            <select id="service" name="service" required>
                                <option value="">Choose one</option>
                                <option>Luxury portfolio</option>
                                <option>Business website</option>
                                <option>PHP/MySQL system</option>
                                <option>Front-end refinement</option>
                            </select>
                            <span class="field-error" data-error-for="service"></span>
                        </div>

                        <div>
                            <label for="budget">Budget</label>
                            <select id="budget" name="budget" required>
                                <option value="">Choose range</option>
                                <option>Starter project</option>
                                <option>Premium build</option>
                                <option>Full custom system</option>
                                <option>Need guidance</option>
                            </select>
                            <span class="field-error" data-error-for="budget"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="message">Project brief</label>
                        <textarea id="message" name="message" rows="5" placeholder="What are you building, who is it for, and what should the website achieve?" required></textarea>
                        <span class="field-error" data-error-for="message"></span>
                    </div>

                    <button class="btn-luxury magnetic form-submit" type="submit">
                        Send private brief
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
