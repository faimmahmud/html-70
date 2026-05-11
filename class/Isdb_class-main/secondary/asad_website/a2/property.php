<?php
$pageTitle = 'Property Details | Aurelia Estates';
$currentPage = 'property';
require_once __DIR__ . '/includes/header.php';

$id = $_GET['id'] ?? 101;
$property = get_property($id) ?: get_featured_properties()[0];
$media = get_property_media((int)$property['id']);
$user = current_user();
?>
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="surface">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <span class="badge badge-soft rounded-pill"><?php echo e($property['listing_type']); ?></span>
              <h1 class="section-title mt-2 mb-1"><?php echo e($property['title']); ?></h1>
              <p class="text-secondary mb-0"><?php echo e($property['address'] ?: ($property['city'] . ', ' . $property['country'])); ?></p>
            </div>
            <div class="text-end">
              <h3 class="mb-0"><?php echo e(money($property['price'])); ?></h3>
              <small class="text-secondary">Status: <?php echo e($property['status']); ?></small>
            </div>
          </div>

          <div class="row g-3 mb-4">
            <div class="col-md-8">
              <img class="w-100 rounded-5" src="<?php echo e($property['image']); ?>" alt="<?php echo e($property['title']); ?>" style="height:420px; object-fit:cover;">
            </div>
            <div class="col-md-4 d-flex flex-column gap-3">
              <?php foreach (array_slice($property['images'] ?? [], 1, 2) as $img): ?>
                <img class="w-100 rounded-5" src="<?php echo e($img); ?>" alt="gallery" style="height:200px; object-fit:cover;">
              <?php endforeach; ?>
            </div>
          </div>

          <div class="row g-3 mb-4 text-center">
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo (int)$property['bedrooms']; ?></div><small class="text-secondary">Bedrooms</small></div></div>
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo (int)$property['bathrooms']; ?></div><small class="text-secondary">Bathrooms</small></div></div>
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo e(number_format((int)$property['area_sqft'])); ?></div><small class="text-secondary">Area sqft</small></div></div>
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo e(number_format((float)$property['rating'], 1)); ?></div><small class="text-secondary">Rating</small></div></div>
          </div>

          <div class="mb-4">
            <h4>About this property</h4>
            <p class="text-secondary"><?php echo e($property['description']); ?></p>
          </div>

          <div class="row g-4">
            <div class="col-md-6">
              <h5>Amenities</h5>
              <ul class="text-secondary">
                <?php foreach (($property['amenities'] ?? []) as $amenity): ?>
                  <li><?php echo e($amenity); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="col-md-6">
              <h5>Geo location</h5>
              <ul class="text-secondary">
                <li>Latitude: <?php echo e($property['latitude']); ?></li>
                <li>Longitude: <?php echo e($property['longitude']); ?></li>
                <li>Map-ready for Google Maps integration</li>
                <li>SEO-friendly slug: <?php echo e($property['slug']); ?></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="surface mt-4">
          <h4>Map integration</h4>
          <div class="map-box mt-3">
            <iframe title="Map" src="https://www.google.com/maps?q=<?php echo urlencode($property['address'] ?: $property['city']); ?>&output=embed" width="100%" height="100%" style="border:0; min-height:360px;" loading="lazy"></iframe>
          </div>
        </div>

        <div class="surface mt-4">
          <h4>Reviews</h4>
          <div class="timeline-item mt-4">
            <div class="fw-semibold">Sophia M.</div>
            <small class="text-secondary">Verified buyer · 5 stars</small>
            <p class="mb-0 text-secondary">Very smooth booking, fast response, and premium presentation.</p>
          </div>
          <div class="timeline-item mt-4">
            <div class="fw-semibold">Daniel K.</div>
            <small class="text-secondary">Investor · 4.8 stars</small>
            <p class="mb-0 text-secondary">Excellent details, helpful neighborhood insight, and easy comparison.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="panel-card p-4">
          <h4>Contact agent</h4>
          <div class="d-flex align-items-center gap-3 mb-3">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle avatar-sm" alt="Agent">
            <div>
              <div class="fw-semibold"><?php echo e($property['agent_name']); ?></div>
              <small class="text-secondary">Response time: 8 min</small>
            </div>
          </div>
          <form action="actions.php" method="post" class="d-grid gap-2">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" value="send_inquiry">
            <input type="hidden" name="property_id" value="<?php echo e($property['id']); ?>">
            <input type="hidden" name="agent_id" value="<?php echo e($property['agent_name'] ? 2 : 2); ?>">
            <textarea name="message" class="form-control" rows="4" placeholder="Tell us what you need..."></textarea>
            <button type="submit" class="btn btn-accent">Send inquiry</button>
          </form>
        </div>

        <div class="panel-card p-4 mt-4">
          <h5>Schedule a tour</h5>
          <form action="actions.php" method="post" class="d-grid gap-2">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" value="create_booking">
            <input type="hidden" name="property_id" value="<?php echo e($property['id']); ?>">
            <input type="hidden" name="agent_id" value="2">
            <input type="hidden" name="price_snapshot" value="<?php echo e($property['price']); ?>">
            <input type="hidden" name="currency" value="<?php echo e($property['currency']); ?>">
            <select name="booking_type" class="form-select">
              <option value="visit">On-site visit</option>
              <option value="virtual">Virtual tour</option>
              <option value="callback">Callback</option>
            </select>
            <input type="datetime-local" name="scheduled_at" class="form-control" required>
            <textarea name="notes" class="form-control" rows="3" placeholder="Preferred time, notes..."></textarea>
            <button class="btn btn-accent">Book tour</button>
          </form>
        </div>

        <div class="panel-card p-4 mt-4">
          <h5>Wishlist & share</h5>
          <div class="d-grid gap-2">
            <button class="btn btn-outline-light wishlist-btn" data-id="<?php echo e($property['id']); ?>"><i class="bi bi-heart me-1"></i>Save</button>
            <a href="compare.php?ids=<?php echo e($property['id']); ?>" class="btn btn-outline-light">Add to compare</a>
          </div>
        </div>

        <div class="panel-card p-4 mt-4">
          <h5>Similar properties</h5>
          <?php foreach (array_slice(get_properties([]), 0, 2) as $item): if ((int)$item['id'] === (int)$property['id']) continue; ?>
          <div class="d-flex gap-3 align-items-center mb-3">
            <img src="<?php echo e($item['image']); ?>" alt="" width="72" height="60" class="rounded-4 object-fit-cover">
            <div>
              <div class="fw-semibold"><?php echo e($item['title']); ?></div>
              <small class="text-secondary"><?php echo e(money($item['price'])); ?></small>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
