(function () {
  const propertyCards = [...document.querySelectorAll('.property-card-wrap')];
  const searchForm = document.getElementById('searchForm');
  const searchLocation = document.getElementById('searchLocation');
  const searchType = document.getElementById('searchType');
  const currencySelect = document.getElementById('currencySelect');
  const filterButtons = document.querySelectorAll('.filter-btn');
  const priceEls = document.querySelectorAll('.price');
  const wishlistButtons = document.querySelectorAll('.wishlist-btn');

  function formatMoney(value, currency) {
    const n = Number(value || 0);
    try {
      return new Intl.NumberFormat('en-US', { style: 'currency', currency }).format(n);
    } catch (e) {
      return '$' + n.toLocaleString('en-US');
    }
  }

  function updateCurrencies(currency) {
    priceEls.forEach(el => {
      const base = el.getAttribute('data-price');
      el.textContent = formatMoney(base, currency);
    });
  }

  function applyFilters() {
    const term = (searchLocation?.value || '').trim().toLowerCase();
    const type = (searchType?.value || '').trim().toLowerCase();
    const activeFilter = document.querySelector('.filter-btn.active')?.dataset.filter || 'all';

    propertyCards.forEach(card => {
      const loc = card.dataset.location || '';
      const cardType = card.dataset.type || '';
      const status = card.dataset.status || '';
      const matchesTerm = !term || loc.includes(term) || cardType.includes(term);
      const matchesType = !type || cardType === type;
      const matchesStatus = activeFilter === 'all' || status === activeFilter;
      card.style.display = (matchesTerm && matchesType && matchesStatus) ? '' : 'none';
    });
  }

  searchForm?.addEventListener('submit', function (e) {
    e.preventDefault();
    applyFilters();
    document.getElementById('listings')?.scrollIntoView({ behavior: 'smooth' });
  });

  searchLocation?.addEventListener('input', applyFilters);
  searchType?.addEventListener('change', applyFilters);
  currencySelect?.addEventListener('change', function () { updateCurrencies(this.value); });

  filterButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      filterButtons.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      applyFilters();
    });
  });

  wishlistButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      this.classList.toggle('active');
      const icon = this.querySelector('i');
      icon.className = this.classList.contains('active') ? 'bi bi-heart-fill' : 'bi bi-heart';
    });
  });

  document.querySelectorAll('.view-details').forEach(btn => {
    btn.addEventListener('click', function () {
      const p = JSON.parse(this.dataset.property || '{}');
      document.getElementById('modalTitle').textContent = p.title || 'Property Details';
      document.getElementById('modalImage').src = p.image || '';
      document.getElementById('modalLocation').textContent = p.location || '';
      document.getElementById('modalPrice').textContent = formatMoney(p.price || 0, p.currency || 'USD');
      document.getElementById('modalDesc').textContent = p.description || '';
      document.getElementById('modalBeds').textContent = p.beds ?? '-';
      document.getElementById('modalBaths').textContent = p.baths ?? '-';
      document.getElementById('modalArea').textContent = p.area ?? '-';

      const gallery = document.getElementById('modalGallery');
      gallery.innerHTML = '';
      (p.gallery || []).forEach(src => {
        const img = document.createElement('img');
        img.src = src;
        img.alt = p.title || 'Property image';
        img.className = 'rounded-4';
        img.style.width = '90px';
        img.style.height = '70px';
        img.style.objectFit = 'cover';
        gallery.appendChild(img);
      });
    });
  });

  applyFilters();
})();
