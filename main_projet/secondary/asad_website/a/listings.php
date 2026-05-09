<?php
$pageTitle = 'Property Listings | Aurelia Estates';
$currentPage = 'buy';
require_once __DIR__ . '/includes/header.php';

$type = $_GET['type'] ?? '';
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Explore listings</span>
        <h1 class="section-title mt-2">Properties for every market.</h1>
        <p class="text-secondary mb-0">Filter by budget, location, bedrooms, bathrooms, and amenities.</p>
      </div>
      <div class="d-flex gap-2">
        <select class="form-select" style="min-width:180px;">
          <option>Newest</option>
          <option>Price low to high</option>
          <option>Popularity</option>
        </select>
        <a href="#" class="btn btn-outline-light"><i class="bi bi-grid-3x3-gap"></i></a>
        <a href="#" class="btn btn-outline-light"><i class="bi bi-map"></i></a>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-3">
        <div class="surface sidebar-filter">
          <h5 class="mb-3">Advanced filters</h5>
          <div class="mb-3">
            <label class="form-label text-secondary">Location</label>
            <input type="text" class="form-control" placeholder="City or neighborhood" data-filter="search">
          </div>
          <div class="mb-3">
            <label class="form-label text-secondary">Property type</label>
            <select class="form-select" data-filter="type">
              <option value="">All</option>
              <option value="Sale" <?php echo $type==='sale' ? 'selected' : ''; ?>>Sale</option>
              <option value="Rent" <?php echo $type==='rent' ? 'selected' : ''; ?>>Rent</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label text-secondary">Bedrooms</label>
            <select class="form-select" data-filter="beds">
              <option value="0">Any</option>
              <option value="2">2+</option>
              <option value="3">3+</option>
              <option value="4">4+</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label text-secondary">Price range</label>
            <input type="range" class="form-range" min="1" max="100">
          </div>
          <div class="mb-3">
            <label class="form-label text-secondary">Amenities</label>
            <div class="d-flex flex-wrap gap-2">
              <span class="badge rounded-pill text-bg-dark border">Pool</span>
              <span class="badge rounded-pill text-bg-dark border">Gym</span>
              <span class="badge rounded-pill text-bg-dark border">Parking</span>
              <span class="badge rounded-pill text-bg-dark border">Balcony</span>
            </div>
          </div>
          <button class="btn btn-accent w-100">Apply filters</button>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="row g-4">
          <?php foreach ($listings as $property): ?>
            <?php if ($type && strtolower($property['type']) !== $type) continue; ?>
            <div class="col-md-6" data-listing-card data-title="<?php echo htmlspecialchars($property['title']); ?>" data-location="<?php echo htmlspecialchars($property['location']); ?>" data-type="<?php echo htmlspecialchars($property['type']); ?>" data-beds="<?php echo $property['beds']; ?>">
              <div class="listing-card h-100">
                <img src="<?php echo $property['image']; ?>" alt="<?php echo htmlspecialchars($property['title']); ?>">
                <div class="body">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge badge-soft"><?php echo htmlspecialchars($property['type']); ?></span>
                    <span class="text-warning"><i class="bi bi-star-fill"></i> <?php echo $property['rating']; ?></span>
                  </div>
                  <h5 class="mb-1"><?php echo htmlspecialchars($property['title']); ?></h5>
                  <p class="small-muted mb-2"><?php echo htmlspecialchars($property['location']); ?></p>
                  <div class="d-flex justify-content-between text-secondary small">
                    <span><?php echo $property['beds']; ?> bd</span>
                    <span><?php echo $property['baths']; ?> ba</span>
                    <span><?php echo $property['area']; ?></span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <strong><?php echo $property['price']; ?></strong>
                    <a href="property.php?id=<?php echo $property['id']; ?>" class="btn btn-outline-light btn-sm">View</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="surface">
          <h5 class="mb-3">Map view</h5>
          <div class="map-box">
            <iframe
              title="Map"
              src="https://www.google.com/maps?q=Dubai&output=embed"
              width="100%"
              height="100%"
              style="border:0; min-height:380px;"
              allowfullscreen=""
              loading="lazy"></iframe>
          </div>
          <p class="text-secondary mt-3 mb-0">Switch between grid and map for a richer discovery experience.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
