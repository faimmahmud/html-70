const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const priceFilter = document.getElementById("priceFilter");
const resetBtn = document.getElementById("resetBtn");
const cards = document.querySelectorAll(".destination-card");
const noResults = document.getElementById("noResults");

function applyFilters() {
  const query = searchInput.value.toLowerCase().trim();
  const category = categoryFilter.value;
  const price = priceFilter.value;

  let visibleCount = 0;

  cards.forEach(card => {
    const name = card.dataset.name;
    const cardCategory = card.dataset.category;
    const cardPrice = parseInt(card.dataset.price, 10);

    let ok = true;

    if (query && !name.includes(query)) ok = false;
    if (category !== "all" && cardCategory !== category) ok = false;

    if (price !== "all") {
      if (price === "low" && cardPrice >= 500) ok = false;
      if (price === "mid" && (cardPrice < 500 || cardPrice > 1200)) ok = false;
      if (price === "high" && cardPrice <= 1200) ok = false;
    }

    card.classList.toggle("d-none", !ok);
    if (ok) visibleCount++;
  });

  noResults.classList.toggle("d-none", visibleCount !== 0);
}

searchInput.addEventListener("input", applyFilters);
categoryFilter.addEventListener("change", applyFilters);
priceFilter.addEventListener("change", applyFilters);

resetBtn.addEventListener("click", () => {
  searchInput.value = "";
  categoryFilter.value = "all";
  priceFilter.value = "all";
  applyFilters();
});

const modal = document.getElementById("detailsModal");
modal.addEventListener("show.bs.modal", event => {
  const button = event.relatedTarget;
  document.getElementById("modalTitle").textContent = button.dataset.name;
  document.getElementById("modalLocation").textContent = button.dataset.location;
  document.getElementById("modalPrice").textContent = button.dataset.price;
  document.getElementById("modalDescription").textContent = button.dataset.description;
  document.getElementById("modalImage").src = button.dataset.image;
  document.getElementById("modalCategory").textContent = button.dataset.category;
});
