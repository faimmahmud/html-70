<?php
$pageTitle = 'Listings | Aurelia Estates';
$currentPage = ($_GET['listing_type'] ?? '') === 'rent' ? 'rent' : 'buy';
require_once __DIR__ . '/includes/header.php';

$filters = [
    'q' => trim((string)($_GET['q'] ?? '')),
    'city' => trim((string)($_GET['city'] ?? '')),
    'listing_type' => trim((string)($_GET['listing_type'] ?? '')),
    'status' => trim((string)($_GET['status'] ?? '')),
    'type' => trim((string)($_GET['type'] ?? '')),
    'min_price' => trim((string)($_GET['min_price'] ?? '')),
    'max_price' => trim((string)($_GET['max_price'] ?? '')),
    'bedrooms' => trim((string)($_GET['bedrooms'] ?? '')),
];
$listings = get_properties($filters);
$allCities = array_values(array_unique(array_map(fn($p) => $p['city'], get_properties([]))));
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Explore listings</span>
        <h1 class="section-title mt-2">Search, filter, compare.</h1>
        <p class="text-secondary mb-0">Built for sale, rent, and short stay inventory.</p>
      </div>
      <div class="d-flex gap-2">
        <a id="compareLink" href="compare.php" class="btn btn-accent"><i class="bi bi-columns-gap me-1"></i>Compare 1-3</a>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-3">
        <div class="surface sidebar-filter">
          <h5 class="mb-3">Filters</h5>
          <form method="get" class="d-grid gap-3">
            <input type="text" id="globalSearch" name="q" value="<?php echo e($filters['q']); ?>" class="form-control" placeholder="Search properties">
            <select name="listing_type" class="form-select" data-filter="listing_type">
              <option value="">Sale or Rent</option>
              <option value="sale" <?php echo $filters['listing_type']==='sale'?'selected':''; ?>>Sale</option>
              <option value="rent" <?php echo $filters['listing_type']==='rent'?'selected':''; ?>>Rent</option>
              <option value="short_stay" <?php echo $filters['listing_type']==='short_stay'?'selected':''; ?>>Short stay</option>
            </select>
            <select name="city" class="form-select" data-filter="city">
              <option value="">All cities</option>
              <?php foreach ($allCities as $city): ?>
                <option value="<?php echo e($city); ?>" <?php echo $filters['city']===$city?'selected':''; ?>><?php echo e($city); ?></option>
              <?php endforeach; ?>
            </select>
            <select name="status" class="form-select" data-filter="status">
              <option value="">Any status</option>
              <option value="live" <?php echo $filters['status']==='live'?'selected':''; ?>>Live</option>
              <option value="pending" <?php echo $filters['status']==='pending'?'selected':''; ?>>Pending</option>
              <option value="sold" <?php echo $filters['status']==='sold'?'selected':''; ?>>Sold</option>
              <option value="rented" <?php echo $filters['status']==='rented'?'selected':''; ?>>Rented</option>
            </select>
            <select name="type" class="form-select" data-filter="type">
              <option value="">All types</option>
              <option value="Apartment" <?php echo $filters['type']==='Apartment'?'selected':''; ?>>Apartment</option>
              <option value="House" <?php echo $filters['type']==='House'?'selected':''; ?>>House</option>
              <option value="Penthouse" <?php echo $filters['type']==='Penthouse'?'selected':''; ?>>Penthouse</option>
              <option value="Condo" <?php echo $filters['type']==='Condo'?'selected':''; ?>>Condo</option>
              <option value="Loft" <?php echo $filters['type']==='Loft'?'selected':''; ?>>Loft</option>
            </select>
            <input type="number" name="min_price" class="form-control" placeholder="Min price" value="<?php echo e($filters['min_price']); ?>">
            <input type="number" name="max_price" class="form-control" placeholder="Max price" value="<?php echo e($filters['max_price']); ?>">
            <select name="bedrooms" class="form-select" data-filter="beds">
              <option value="">Bedrooms</option>
              <option value="1" <?php echo $filters['bedrooms']==='1'?'selected':''; ?>>1+</option>
              <option value="2" <?php echo $filters['bedrooms']==='2'?'selected':''; ?>>2+</option>
              <option value="3" <?php echo $filters['bedrooms']==='3'?'selected':''; ?>>3+</option>
              <option value="4" <?php echo $filters['bedrooms']==='4'?'selected':''; ?>>4+</option>
            </select>
            <button class="btn btn-accent">Apply filters</button>
          </form>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="row g-4">
          <?php foreach ($listings as $property): ?>
            <div class="col-md-6" data-listing-card data-title="<?php echo e($property['title']); ?>" data-location="<?php echo e($property['city'] . ' ' . $property['neighborhood']); ?>" data-type="<?php echo e($property['property_type']); ?>" data-city="<?php echo e($property['city']); ?>" data-status="<?php echo e($property['status']); ?>" data-beds="<?php echo e($property['bedrooms']); ?>" data-price="<?php echo e($property['price']); ?>" data-listing-type="<?php echo e($property['listing_type']); ?>">
              <div class="listing-card h-100">
                <img src="<?php echo e($property['image']); ?>" alt="<?php echo e($property['title']); ?>">
                <div class="body">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge badge-soft"><?php echo e($property['property_type']); ?></span>
                    <span class="text-warning"><i class="bi bi-star-fill"></i> <?php echo e(number_format((float)$property['rating'], 1)); ?></span>
                  </div>
                  <h5 class="mb-1"><?php echo e($property['title']); ?></h5>
                  <p class="small-muted mb-2"><?php echo e($property['city']); ?>, <?php echo e($property['country']); ?></p>
                  <div class="d-flex justify-content-between text-secondary small">
                    <span><?php echo (int)$property['bedrooms']; ?> bd</span>
                    <span><?php echo (int)$property['bathrooms']; ?> ba</span>
                    <span><?php echo e(number_format((int)$property['area_sqft'])); ?> sqft</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <strong><?php echo e(money($property['price'])); ?></strong>
                    <a href="property.php?id=<?php echo e($property['id']); ?>" class="btn btn-outline-light btn-sm">View</a>
                  </div>
                  <div class="mt-3 d-flex gap-2 flex-wrap">
                    <input class="form-check-input compare-check" type="checkbox" value="<?php echo e($property['id']); ?>" id="cmp<?php echo e($property['id']); ?>">
                    <label for="cmp<?php echo e($property['id']); ?>" class="small text-secondary">Compare</label>
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
            <iframe title="Map" src="https://www.google.com/maps?q=Dubai&output=embed" width="100%" height="100%" style="border:0; min-height:380px;" loading="lazy"></iframe>
          </div>
          <p class="text-secondary mt-3 mb-0">Use the map for location-based discovery.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
