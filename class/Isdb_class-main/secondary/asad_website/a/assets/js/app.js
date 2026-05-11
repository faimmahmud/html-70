document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.querySelector('#globalSearch');
  const listingCards = document.querySelectorAll('[data-listing-card]');
  const filterInputs = document.querySelectorAll('[data-filter]');

  const applyFilters = () => {
    const query = (searchInput?.value || '').toLowerCase().trim();
    const type = document.querySelector('[data-filter="type"]')?.value || '';
    const minBeds = parseInt(document.querySelector('[data-filter="beds"]')?.value || '0', 10);

    listingCards.forEach(card => {
      const text = (card.dataset.title + ' ' + card.dataset.location + ' ' + card.dataset.type).toLowerCase();
      const beds = parseInt(card.dataset.beds || '0', 10);
      const matchesQuery = !query || text.includes(query);
      const matchesType = !type || card.dataset.type === type;
      const matchesBeds = !minBeds || beds >= minBeds;
      card.style.display = (matchesQuery && matchesType && matchesBeds) ? '' : 'none';
    });
  };

  if (searchInput) searchInput.addEventListener('input', applyFilters);
  filterInputs.forEach(el => el.addEventListener('change', applyFilters));

  document.querySelectorAll('[data-save-btn]').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('btn-outline-light');
      btn.classList.toggle('btn-accent');
      btn.innerHTML = btn.classList.contains('btn-accent')
        ? '<i class="bi bi-heart-fill me-1"></i>Saved'
        : '<i class="bi bi-heart me-1"></i>Save';
    });
  });

  document.querySelectorAll('[data-toast]').forEach(el => {
    el.addEventListener('click', () => {
      alert(el.dataset.toast);
    });
  });
});
