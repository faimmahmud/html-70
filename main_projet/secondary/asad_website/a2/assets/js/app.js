document.addEventListener('DOMContentLoaded', () => {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];

  // live filter on listing page
  const searchInput = $('#globalSearch');
  const listingCards = $$('[data-listing-card]');
  const filterInputs = $$('[data-filter]');

  const applyFilters = () => {
    const query = (searchInput?.value || '').toLowerCase().trim();
    const type = $('[data-filter="type"]')?.value || '';
    const listingType = $('[data-filter="listing_type"]')?.value || '';
    const city = $('[data-filter="city"]')?.value || '';
    const status = $('[data-filter="status"]')?.value || '';
    const minBeds = parseInt($('[data-filter="beds"]')?.value || '0', 10);
    const minPrice = parseInt($('[data-filter="min_price"]')?.value || '0', 10);

    listingCards.forEach(card => {
      const data = `${card.dataset.title} ${card.dataset.location} ${card.dataset.type} ${card.dataset.city} ${card.dataset.status}`.toLowerCase();
      const beds = parseInt(card.dataset.beds || '0', 10);
      const price = parseInt(card.dataset.price || '0', 10);
      const matches = (
        (!query || data.includes(query)) &&
        (!type || card.dataset.type === type) &&
        (!listingType || card.dataset.listingType === listingType) &&
        (!city || card.dataset.city === city) &&
        (!status || card.dataset.status === status) &&
        (!minBeds || beds >= minBeds) &&
        (!minPrice || price >= minPrice)
      );
      card.style.display = matches ? '' : 'none';
    });
  };

  if (searchInput) searchInput.addEventListener('input', applyFilters);
  filterInputs.forEach(el => el.addEventListener('change', applyFilters));

  // saved wishlist buttons
  $$('.wishlist-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      if (!id) return;
      const form = new FormData();
      form.append('action', 'toggle_favorite');
      form.append('property_id', id);
      form.append('_csrf', window.CSRF_TOKEN || '');
      const res = await fetch('actions.php', { method: 'POST', body: form });
      const json = await res.json().catch(() => ({}));
      if (json?.success) {
        btn.classList.toggle('btn-accent');
        btn.classList.toggle('btn-outline-light');
        btn.innerHTML = btn.classList.contains('btn-accent') ? '<i class="bi bi-heart-fill me-1"></i>Saved' : '<i class="bi bi-heart me-1"></i>Save';
      }
    });
  });

  // compare selection
  $$('.compare-check').forEach(chk => chk.addEventListener('change', () => {
    const selected = $$('.compare-check:checked').map(x => x.value).slice(0, 3);
    const link = $('#compareLink');
    if (link) link.href = 'compare.php?ids=' + selected.join(',');
  }));

  // ajax search suggestions
  const ajaxSearch = $('#ajaxSearch');
  const suggestions = $('#suggestions');
  let timer = null;
  if (ajaxSearch && suggestions) {
    ajaxSearch.addEventListener('input', () => {
      clearTimeout(timer);
      timer = setTimeout(async () => {
        const q = ajaxSearch.value.trim();
        if (!q) { suggestions.innerHTML = ''; suggestions.classList.add('d-none'); return; }
        const res = await fetch(`api/search.php?q=${encodeURIComponent(q)}`);
        const json = await res.json().catch(() => null);
        const items = json?.data || [];
        suggestions.innerHTML = items.slice(0, 6).map(item => `
          <a class="dropdown-item py-2" href="property.php?id=${item.id}">
            <div class="fw-semibold">${item.title}</div>
            <small class="text-secondary">${item.city || item.location || ''}</small>
          </a>
        `).join('') || '<div class="dropdown-item text-secondary">No matches</div>';
        suggestions.classList.remove('d-none');
      }, 250);
    });
    document.addEventListener('click', (e) => {
      if (!suggestions.contains(e.target) && e.target !== ajaxSearch) suggestions.classList.add('d-none');
    });
  }

  // calculator widgets
  const emiForm = $('#emiForm');
  const emiResult = $('#emiResult');
  if (emiForm && emiResult) {
    emiForm.addEventListener('input', () => {
      const principal = parseFloat($('#emiPrice').value || '0');
      const down = parseFloat($('#emiDown').value || '0');
      const annual = parseFloat($('#emiRate').value || '0');
      const months = parseInt($('#emiMonths').value || '1', 10);
      const loan = Math.max(principal - down, 0);
      const r = annual / 12 / 100;
      const emi = r ? (loan * r * Math.pow(1 + r, months)) / (Math.pow(1 + r, months) - 1) : loan / months;
      emiResult.textContent = isFinite(emi) ? emi.toFixed(2) : '0.00';
    });
  }

  const costForm = $('#costForm');
  const costResult = $('#costResult');
  if (costForm && costResult) {
    const calcCost = () => {
      const sqft = parseFloat($('#costSqft').value || '0');
      const cement = parseFloat($('#cementRate').value || '0');
      const brick = parseFloat($('#brickRate').value || '0');
      const sand = parseFloat($('#sandRate').value || '0');
      const rod = parseFloat($('#rodRate').value || '0');
      const labor = parseFloat($('#laborRate').value || '0');
      const estimate = sqft * ((cement + brick + sand + rod + labor) || 0);
      costResult.textContent = estimate.toLocaleString(undefined, { maximumFractionDigits: 0 });
    };
    costForm.addEventListener('input', calcCost);
    calcCost();
  }

  // PWA
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => navigator.serviceWorker.register('sw.js').catch(() => {}));
  }

  // toast fallback buttons
  $$('[data-toast]').forEach(el => el.addEventListener('click', () => alert(el.dataset.toast)));
});
