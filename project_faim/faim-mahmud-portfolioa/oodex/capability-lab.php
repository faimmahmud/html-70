<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Capability Lab | faim mahmud';
$pageDescription = 'A premium capability lab showing how faim mahmud turns HTML5, CSS3, Bootstrap 5, JavaScript, jQuery, PHP, and MySQL into polished web systems.';
$activePage = 'capability';

require __DIR__ . '/includes/header.php';
?>

<main id="main" class="page-shell">
    <section id="top" class="secondary-hero lab-hero" aria-labelledby="lab-title">
        <div class="scroll-progress" data-scroll-progress aria-hidden="true"></div>
        <div class="container-fluid px-3 px-lg-5">
            <div class="page-hero-grid">
                <div class="page-hero-copy">
                    <p class="eyebrow reveal">Capability Lab / practical proof</p>
                    <h1 id="lab-title" class="page-title reveal">The stack is simple. The execution is rare.</h1>
                    <p class="page-lede reveal">
                        This page turns my core skills into a premium demonstration of judgment: semantic structure, responsive systems, interaction design, PHP workflows, and MySQL-ready lead infrastructure.
                    </p>
                    <div class="hero-actions reveal">
                        <a class="btn-luxury magnetic" href="#stack">Explore the stack</a>
                        <a class="btn-ghost magnetic" href="index.php#contact">Discuss a build</a>
                    </div>
                </div>

                <div class="page-console reveal tilt-card" aria-label="Capability status board">
                    <div class="console-topline">
                        <span>FM LAB</span>
                        <span>2030 READY</span>
                    </div>
                    <div class="console-grid">
                        <div><strong>HTML5</strong><span>Semantic skeleton</span></div>
                        <div><strong>CSS3</strong><span>Luxury visual system</span></div>
                        <div><strong>Bootstrap</strong><span>Responsive architecture</span></div>
                        <div><strong>JS</strong><span>Interaction layer</span></div>
                        <div><strong>jQuery</strong><span>Fast enhancement</span></div>
                        <div><strong>PHP</strong><span>Server logic</span></div>
                        <div><strong>MySQL</strong><span>Structured storage</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="stack" class="section-block lab-stack-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Demo skills</span>
                <span>01</span>
            </div>
            <div class="split-grid">
                <h2 class="section-title reveal">Every skill is shown as a business capability.</h2>
                <p class="section-copy reveal">
                    A world-class portfolio should not only list tools. It should show how each tool reduces risk, improves trust, and turns a visitor into a serious lead.
                </p>
            </div>

            <div class="lab-card-grid">
                <article class="lab-card reveal tilt-card">
                    <span>HTML5</span>
                    <h3>Structure with meaning</h3>
                    <p>Sections, landmarks, accessible form flow, SEO-ready metadata, and markup that keeps the page understandable for people and machines.</p>
                </article>
                <article class="lab-card reveal tilt-card">
                    <span>CSS3</span>
                    <h3>Luxury visual system</h3>
                    <p>Responsive spacing, premium color tokens, glass texture, readable type, restrained motion, and mobile-safe layout rules.</p>
                </article>
                <article class="lab-card reveal tilt-card">
                    <span>Bootstrap 5</span>
                    <h3>Fast responsive foundation</h3>
                    <p>Grid structure, navigation behavior, form foundations, utility helpers, and predictable responsive logic without heavy frameworks.</p>
                </article>
                <article class="lab-card reveal tilt-card">
                    <span>JavaScript</span>
                    <h3>Interaction without noise</h3>
                    <p>Scroll progress, page reveals, magnetic controls, tilt panels, active navigation, and motion that helps the visitor feel guided.</p>
                </article>
                <article class="lab-card reveal tilt-card">
                    <span>jQuery</span>
                    <h3>Practical enhancement</h3>
                    <p>Lean event handling, AJAX contact submission, progressive UI states, and fast integration for classic PHP websites.</p>
                </article>
                <article class="lab-card reveal tilt-card">
                    <span>PHP + MySQL</span>
                    <h3>Lead-ready backend</h3>
                    <p>Validated contact data, CSRF protection, PDO prepared statements, clean config, and a database path that can grow into admin review.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block demo-theatre-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Interaction theatre</span>
                <span>02</span>
            </div>
            <div class="theatre-grid">
                <article class="theatre-panel reveal">
                    <p class="panel-index">Interface</p>
                    <h2>Calm motion, sharp hierarchy, no template energy.</h2>
                    <p>The UI uses movement as a signal. Buttons respond, cards breathe, sections arrive with timing, and the page never asks the visitor to fight the design.</p>
                    <div class="kinetic-bars" aria-hidden="true">
                        <span></span><span></span><span></span><span></span>
                    </div>
                </article>
                <article class="theatre-panel reveal">
                    <p class="panel-index">Backend</p>
                    <h2>Small system, serious behavior.</h2>
                    <p>The contact flow is not decoration. It validates, protects, stores, and reports clear status messages so the portfolio can become a real client pipeline.</p>
                    <div class="system-lines" aria-hidden="true">
                        <span>POST /api/contact.php</span>
                        <span>validate + protect</span>
                        <span>PDO -> contact_messages</span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block quality-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="section-kicker reveal">
                <span>Quality protocol</span>
                <span>03</span>
            </div>
            <div class="quality-grid">
                <div class="quality-copy reveal">
                    <h2 class="section-title">The difference is not the stack. It is the taste applied to the stack.</h2>
                </div>
                <div class="quality-list">
                    <div class="quality-item reveal"><strong>Readable</strong><span>Layouts that feel clear on phones, laptops, and large screens.</span></div>
                    <div class="quality-item reveal"><strong>Fast</strong><span>Local assets, no heavy front-end framework, and focused JavaScript.</span></div>
                    <div class="quality-item reveal"><strong>Trustworthy</strong><span>Real validation, secure database writes, clear setup docs.</span></div>
                    <div class="quality-item reveal"><strong>Memorable</strong><span>Texture, type, rhythm, and copy that make the brand feel premium.</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block final-route-section">
        <div class="container-fluid px-3 px-lg-5">
            <div class="final-route reveal">
                <p class="eyebrow">Next move</p>
                <h2>See the full brand system behind the work.</h2>
                <a class="btn-luxury magnetic" href="all.php">Open All</a>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
