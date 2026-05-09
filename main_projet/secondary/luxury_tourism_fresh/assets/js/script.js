
(function(){
  const dot = document.querySelector('.cursor-dot');
  const ring = document.querySelector('.cursor-ring');
  let mx = 0, my = 0, rx = 0, ry = 0;

  document.addEventListener('mousemove', (e) => { mx = e.clientX; my = e.clientY; });
  function animateCursor(){
    rx += (mx - rx) * 0.14;
    ry += (my - ry) * 0.14;
    if (dot) dot.style.left = mx + 'px', dot.style.top = my + 'px';
    if (ring) ring.style.left = rx + 'px', ring.style.top = ry + 'px';
    requestAnimationFrame(animateCursor);
  }
  animateCursor();

  document.querySelectorAll('a, button, .filter-chip, .card-premium, .country-card').forEach(el => {
    el.addEventListener('mouseenter', ()=> ring && (ring.style.width='52px', ring.style.height='52px', ring.style.borderColor='rgba(29,78,216,.45)'));
    el.addEventListener('mouseleave', ()=> ring && (ring.style.width='34px', ring.style.height='34px', ring.style.borderColor='rgba(15,23,42,.25)'));
  });

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e){
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
      }
    });
  });

  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting) entry.target.classList.add('show');
    });
  }, {threshold: 0.12});
  revealEls.forEach(el => io.observe(el));

  const slides = document.querySelectorAll('[data-parallax]');
  window.addEventListener('scroll', () => {
    const y = window.scrollY;
    slides.forEach((el, i) => {
      const speed = parseFloat(el.dataset.parallax || '0.2');
      el.style.transform = `translate3d(0, ${y * speed * -1}px, 0) scale(1.08)`;
    });
  }, {passive:true});

  const filters = document.querySelectorAll('[data-filter]');
  if (filters.length) {
    filters.forEach(btn => btn.addEventListener('click', function(){
      const filter = this.dataset.filter;
      filters.forEach(x => x.classList.remove('active'));
      this.classList.add('active');
      document.querySelectorAll('[data-cat]').forEach(card => {
        const show = filter === 'all' || card.dataset.cat === filter;
        card.style.display = show ? '' : 'none';
      });
    }));
  }

  // booking AJAX
  const bookingForm = document.querySelector('#bookingForm');
  if (bookingForm) {
    bookingForm.addEventListener('submit', function(e){
      e.preventDefault();
      const form = new FormData(this);
      form.append('action', 'booking');
      fetch('api.php', { method:'POST', body: form })
        .then(r => r.json())
        .then(data => {
          const box = document.querySelector('#bookingResult');
          if (box) {
            box.className = 'alert mt-3 ' + (data.ok ? 'alert-success' : 'alert-danger');
            box.textContent = data.message;
          }
          if (data.ok) this.reset();
        }).catch(() => {
          const box = document.querySelector('#bookingResult');
          if (box) {
            box.className = 'alert mt-3 alert-danger';
            box.textContent = 'Submission failed. Please try again.';
          }
        });
    });
  }

  // login/register ajax
  document.querySelectorAll('[data-auth-form]').forEach(form => {
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const fd = new FormData(this);
      fd.append('action', this.dataset.authForm);
      fetch('api.php', { method:'POST', body: fd })
        .then(r => r.json()).then(data => {
          const out = this.querySelector('.form-message');
          if (out) {
            out.className = 'form-message alert mt-3 ' + (data.ok ? 'alert-success' : 'alert-danger');
            out.textContent = data.message;
          }
          if (data.ok && data.redirect) setTimeout(() => window.location.href = data.redirect, 500);
        });
    });
  });

  // packages loader
  const packWrap = document.querySelector('#packagesLoader');
  if (packWrap) {
    fetch('api.php?action=packages')
      .then(r => r.json())
      .then(data => {
        packWrap.innerHTML = data.html;
      });
  }
})();
