<?php
$pageTitle = 'Property Detail | Aurelia Estates';
$currentPage = 'property';
require_once __DIR__ . '/includes/header.php';

$id = $_GET['id'] ?? 101;
$property = null;
foreach ($listings as $item) {
    if ((string)$item['id'] === (string)$id) {
        $property = $item;
        break;
    }
}
if (!$property) {
    $property = $featuredProperties[0];
}
?>
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="surface">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <span class="badge badge-soft rounded-pill"><?php echo htmlspecialchars($property['type'] ?? 'Sale'); ?></span>
              <h1 class="section-title mt-2 mb-1"><?php echo htmlspecialchars($property['title']); ?></h1>
              <p class="text-secondary mb-0"><?php echo htmlspecialchars($property['location']); ?></p>
            </div>
            <div class="text-end">
              <h3 class="mb-0"><?php echo htmlspecialchars($property['price']); ?></h3>
              <small class="text-secondary">Global listing price</small>
            </div>
          </div>

          <div class="row g-3 mb-4">
            <div class="col-md-8">
              <img class="w-100 rounded-5" src="<?php echo $property['image']; ?>" alt="<?php echo htmlspecialchars($property['title']); ?>" style="height:420px; object-fit:cover;">
            </div>
            <div class="col-md-4 d-flex flex-column gap-3">
              <img class="w-100 rounded-5" src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80" alt="gallery 2" style="height:200px; object-fit:cover;">
              <img class="w-100 rounded-5" src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80" alt="gallery 3" style="height:200px; object-fit:cover;">
            </div>
          </div>

          <div class="row g-3 mb-4 text-center">
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo $property['beds']; ?></div><small class="text-secondary">Bedrooms</small></div></div>
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo $property['baths']; ?></div><small class="text-secondary">Bathrooms</small></div></div>
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo $property['area']; ?></div><small class="text-secondary">Area</small></div></div>
            <div class="col-6 col-md-3"><div class="panel-card p-3"><div class="fw-bold"><?php echo $property['rating'] ?? '4.9'; ?></div><small class="text-secondary">Rating</small></div></div>
          </div>

          <div class="mb-4">
            <h4>About this property</h4>
            <p class="text-secondary">
              This premium residence combines modern architecture with high-end amenities, smart layout planning, and seamless indoor-outdoor living.
              Built for international buyers and tenants, it offers a polished lifestyle experience with excellent access to transport, retail, and dining.
            </p>
          </div>

          <div class="row g-4">
            <div class="col-md-6">
              <h5>Amenities</h5>
              <ul class="text-secondary">
                <li>Infinity pool and spa</li>
                <li>Private parking and security</li>
                <li>Gym, lounge, and concierge</li>
                <li>Furnished with premium finishes</li>
              </ul>
            </div>
            <div class="col-md-6">
              <h5>Neighborhood overview</h5>
              <ul class="text-secondary">
                <li>12 min to city center</li>
                <li>Near international schools</li>
                <li>Walkable shopping district</li>
                <li>Fast access to transit</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="surface mt-4">
          <h4>Map integration</h4>
          <div class="map-box mt-3">
            <iframe title="Map" src="https://www.google.com/maps?q=<?php echo urlencode($property['location']); ?>&output=embed" width="100%" height="100%" style="border:0; min-height:360px;" loading="lazy"></iframe>
          </div>
        </div>

        <div class="surface mt-4">
          <h4>Reviews and ratings</h4>
          <div class="timeline-item mt-4">
            <div class="fw-semibold">Sophia M.</div>
            <small class="text-secondary">Verified buyer · 5 stars</small>
            <p class="mb-0 text-secondary">A beautiful, well-managed listing with fast agent communication and a very smooth booking process.</p>
          </div>
          <div class="timeline-item mt-4">
            <div class="fw-semibold">Daniel K.</div>
            <small class="text-secondary">Investor · 4.8 stars</small>
            <p class="mb-0 text-secondary">The listing presentation and neighborhood data made due diligence much easier.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="panel-card p-4">
          <h4>Contact agent</h4>
          <div class="d-flex align-items-center gap-3 mb-3">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle" width="56" height="56" alt="Agent">
            <div>
              <div class="fw-semibold">Michael Chen</div>
              <small class="text-secondary">Response time: 8 min</small>
            </div>
          </div>
          <form class="d-grid gap-2">
            <input type="text" class="form-control" placeholder="Your name">
            <input type="email" class="form-control" placeholder="Your email">
            <textarea class="form-control" rows="4" placeholder="Tell us what you need..."></textarea>
            <button type="button" class="btn btn-accent" data-toast="Your inquiry has been sent to the agent.">Contact now</button>
            <button type="button" class="btn btn-outline-light">Book a visit</button>
          </form>
        </div>

        <div class="panel-card p-4 mt-4">
          <h5>Booking</h5>
          <p class="text-secondary">Schedule a private or virtual viewing with multi-currency payment support.</p>
          <input type="date" class="form-control mb-2">
          <select class="form-select mb-2">
            <option>Morning</option>
            <option>Afternoon</option>
            <option>Evening</option>
          </select>
          <button class="btn btn-accent w-100" data-toast="Your visit has been requested.">Schedule visit</button>
        </div>

        <div class="panel-card p-4 mt-4">
          <h5>Similar properties</h5>
          <div class="d-flex gap-3 align-items-center mb-3">
            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=400&q=80" alt="" width="72" height="60" class="rounded-4 object-fit-cover">
            <div>
              <div class="fw-semibold">Waterfront Sky Villa</div>
              <small class="text-secondary">$3.8M</small>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-center">
            <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=400&q=80" alt="" width="72" height="60" class="rounded-4 object-fit-cover">
            <div>
              <div class="fw-semibold">Urban Designer Loft</div>
              <small class="text-secondary">$12,000 / mo</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
