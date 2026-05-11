/* =====================================================
   FAHIM MAHMUD PORTFOLIO — Global JavaScript
   World-Class Edition
   ===================================================== */

(function () {
  'use strict';

  /* ── 1. PRELOADER ─────────────────────────────── */
  function initPreloader() {
    const pl     = document.querySelector('.preloader');
    if (!pl) { initAll(); return; }

    const fill   = pl.querySelector('.preloader__bar-fill');
    const pct    = pl.querySelector('.preloader__pct');
    const spans  = pl.querySelectorAll('.preloader__name span');

    document.body.style.overflow = 'hidden';

    // Animate name letters
    spans.forEach((s, i) => {
      setTimeout(() => {
        s.style.transform = 'translateY(0)';
        s.style.opacity   = '1';
      }, 180 + i * 55);
    });

    // Fake progress
    let p = 0;
    const tick = setInterval(() => {
      p += Math.random() * 2.8 + 0.6;
      if (p >= 100) {
        p = 100;
        clearInterval(tick);
        fill.style.width = '100%';
        if (pct) pct.textContent = '100%';
        setTimeout(() => {
          pl.style.transition = 'opacity 0.9s ease';
          pl.style.opacity    = '0';
          setTimeout(() => {
            pl.remove();
            document.body.style.overflow = '';
            initAll();
          }, 900);
        }, 420);
      } else {
        fill.style.width = p + '%';
        if (pct) pct.textContent = Math.floor(p) + '%';
      }
    }, 28);
  }

  /* ── 2. CUSTOM CURSOR ─────────────────────────── */
  function initCursor() {
    if (window.innerWidth <= 768) return;

    const dot  = document.querySelector('.cursor');
    const ring = document.querySelector('.cursor-ring');
    if (!dot || !ring) return;

    let mx = 0, my = 0, rx = 0, ry = 0;

    document.addEventListener('mousemove', e => {
      mx = e.clientX; my = e.clientY;
      dot.style.left = mx + 'px';
      dot.style.top  = my + 'px';
    });

    (function raf() {
      rx += (mx - rx) * 0.10;
      ry += (my - ry) * 0.10;
      ring.style.left = rx + 'px';
      ring.style.top  = ry + 'px';
      requestAnimationFrame(raf);
    })();

    document.querySelectorAll('a, button, .mag, [data-cursor]').forEach(el => {
      el.addEventListener('mouseenter', () => { dot.classList.add('hovered'); ring.classList.add('hovered'); });
      el.addEventListener('mouseleave', () => { dot.classList.remove('hovered'); ring.classList.remove('hovered'); });
    });

    document.addEventListener('mouseleave', () => { dot.style.opacity = '0'; ring.style.opacity = '0'; });
    document.addEventListener('mouseenter', () => { dot.style.opacity = ''; ring.style.opacity = ''; });
  }

  /* ── 3. NAVIGATION ────────────────────────────── */
  function initNav() {
    const nav    = document.querySelector('.nav');
    const burger = document.querySelector('.nav__burger');
    const mob    = document.querySelector('.mob-menu');
    if (!nav) return;

    window.addEventListener('scroll', () => {
      nav.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });

    if (burger && mob) {
      burger.addEventListener('click', () => {
        burger.classList.toggle('open');
        mob.classList.toggle('open');
        document.body.style.overflow = mob.classList.contains('open') ? 'hidden' : '';
      });
      mob.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
        burger.classList.remove('open');
        mob.classList.remove('open');
        document.body.style.overflow = '';
      }));
    }

    // Active link
    const page = location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav__links a, .mob-menu a').forEach(a => {
      if (a.getAttribute('href') === page) a.classList.add('active');
    });
  }

  /* ── 4. MAGNETIC BUTTONS ──────────────────────── */
  function initMagnetic() {
    document.querySelectorAll('.mag').forEach(el => {
      el.addEventListener('mousemove', e => {
        const r = el.getBoundingClientRect();
        const x = e.clientX - r.left - r.width / 2;
        const y = e.clientY - r.top  - r.height / 2;
        el.style.transform = `translate(${x * 0.28}px, ${y * 0.28}px)`;
      });
      el.addEventListener('mouseleave', () => { el.style.transform = ''; });
    });
  }

  /* ── 5. SCROLL REVEAL ─────────────────────────── */
  function initScrollReveal() {
    const els = document.querySelectorAll('.rv');
    if (!els.length) return;

    const io = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    els.forEach(el => io.observe(el));
  }

  /* ── 6. COUNTER ANIMATION ─────────────────────── */
  function initCounters() {
    const counters = document.querySelectorAll('.count');
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        io.unobserve(e.target);
        const el  = e.target;
        const end = parseInt(el.dataset.target, 10);
        const dur = 1800;
        const start = performance.now();
        (function tick(now) {
          const t = Math.min((now - start) / dur, 1);
          const ease = 1 - Math.pow(1 - t, 3);
          el.textContent = Math.floor(ease * end);
          if (t < 1) requestAnimationFrame(tick);
          else el.textContent = end;
        })(start);
      });
    }, { threshold: 0.5 });
    counters.forEach(c => io.observe(c));
  }

  /* ── 7. PROGRESS BARS ─────────────────────────── */
  function initSkillBars() {
    const bars = document.querySelectorAll('.skill-bar__fill');
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        io.unobserve(e.target);
        const w = e.target.dataset.w;
        e.target.style.width = w + '%';
      });
    }, { threshold: 0.3 });
    bars.forEach(b => io.observe(b));
  }

  /* ── 8. PAGE TRANSITION ───────────────────────── */
  function initPageTransition() {
    const trans = document.querySelector('.page-trans');
    if (!trans) return;
    document.querySelectorAll('a').forEach(a => {
      const href = a.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('mailto') || href.startsWith('tel') || a.getAttribute('target') === '_blank') return;
      a.addEventListener('click', e => {
        e.preventDefault();
        trans.style.transform = 'scaleY(1)';
        trans.style.transformOrigin = 'bottom';
        setTimeout(() => { location.href = href; }, 680);
      });
    });
    // Reveal on new page
    trans.style.transformOrigin = 'top';
    trans.style.transform       = 'scaleY(1)';
    requestAnimationFrame(() => requestAnimationFrame(() => {
      trans.style.transition = 'transform 0.7s cubic-bezier(0.16,1,0.3,1)';
      trans.style.transform  = 'scaleY(0)';
    }));
  }

  /* ── 9. HERO ACTIVATION ───────────────────────── */
  function initHero() {
    const hero = document.querySelector('.hero');
    if (!hero) return;
    setTimeout(() => hero.classList.add('active'), 200);
  }

  /* ── 10. PARTICLES CANVAS (hero) ─────────────── */
  function initParticles() {
    const canvas = document.getElementById('heroCanvas');
    if (!canvas) return;
    const ctx    = canvas.getContext('2d');
    let W, H, pts;

    function resize() {
      W = canvas.width  = canvas.offsetWidth;
      H = canvas.height = canvas.offsetHeight;
    }
    resize();
    window.addEventListener('resize', () => { resize(); buildPts(); });

    function buildPts() {
      const n = Math.floor((W * H) / 14000);
      pts = Array.from({ length: n }, () => ({
        x: Math.random() * W,
        y: Math.random() * H,
        vx: (Math.random() - 0.5) * 0.28,
        vy: (Math.random() - 0.5) * 0.28,
        r: Math.random() * 1.2 + 0.3,
      }));
    }
    buildPts();

    const gold = 'rgba(201,169,110,';

    (function loop() {
      ctx.clearRect(0, 0, W, H);
      pts.forEach(p => {
        p.x += p.vx; p.y += p.vy;
        if (p.x < 0) p.x = W; if (p.x > W) p.x = 0;
        if (p.y < 0) p.y = H; if (p.y > H) p.y = 0;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = gold + '0.45)';
        ctx.fill();
      });
      for (let i = 0; i < pts.length; i++) {
        for (let j = i + 1; j < pts.length; j++) {
          const dx = pts[i].x - pts[j].x;
          const dy = pts[i].y - pts[j].y;
          const d  = Math.sqrt(dx * dx + dy * dy);
          if (d < 130) {
            ctx.beginPath();
            ctx.moveTo(pts[i].x, pts[i].y);
            ctx.lineTo(pts[j].x, pts[j].y);
            ctx.strokeStyle = gold + (0.12 * (1 - d / 130)) + ')';
            ctx.lineWidth   = 0.5;
            ctx.stroke();
          }
        }
      }
      requestAnimationFrame(loop);
    })();
  }

  /* ── 11. PARALLAX ─────────────────────────────── */
  function initParallax() {
    const els = document.querySelectorAll('[data-parallax]');
    if (!els.length) return;
    window.addEventListener('scroll', () => {
      const sy = window.scrollY;
      els.forEach(el => {
        const speed = parseFloat(el.dataset.parallax) || 0.3;
        el.style.transform = `translateY(${sy * speed}px)`;
      });
    }, { passive: true });
  }

  /* ── 12. TABS (works filter) ──────────────────── */
  function initTabs() {
    const tabs  = document.querySelectorAll('.filter-tab');
    const cards = document.querySelectorAll('.proj-card');
    if (!tabs.length) return;

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const cat = tab.dataset.cat;
        cards.forEach(card => {
          if (cat === 'all' || card.dataset.cat === cat) {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            card.style.display = 'block';
            setTimeout(() => { card.style.opacity = '1'; card.style.transform = ''; }, 10);
          } else {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            setTimeout(() => { card.style.display = 'none'; }, 350);
          }
        });
      });
    });
  }

  /* ── RUN ALL ──────────────────────────────────── */
  function initAll() {
    initCursor();
    initNav();
    initMagnetic();
    initScrollReveal();
    initCounters();
    initSkillBars();
    initPageTransition();
    initHero();
    initParticles();
    initParallax();
    initTabs();
  }

  document.addEventListener('DOMContentLoaded', initPreloader);

})();
