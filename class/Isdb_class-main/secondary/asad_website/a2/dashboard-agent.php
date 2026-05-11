<?php
$pageTitle = 'Agent Dashboard | Aurelia Estates';
$currentPage = 'dashboard';
require_once __DIR__ . '/includes/header.php';
require_role(['agent','seller','admin']);
$props = get_properties([]);
$editId = (int)($_GET['edit'] ?? 0);
$editing = $editId ? get_property($editId) : null;
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Agent workspace</span>
        <h1 class="section-title mt-2">Manage listings, leads, and performance.</h1>
      </div>
      <button class="btn btn-accent" data-bs-toggle="collapse" data-bs-target="#propertyForm">Add new property</button>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Views</div><div class="h2 mb-0">24.8K</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Leads</div><div class="h2 mb-0">312</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Bookings</div><div class="h2 mb-0">58</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Conversion</div><div class="h2 mb-0">12.4%</div></div></div>
    </div>

    <div class="collapse" id="propertyForm">
      <div class="surface mb-4">
        <h4 class="mb-3">Create / update property</h4>
        <form action="actions.php" method="post" enctype="multipart/form-data" class="row g-3">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="action" value="<?php echo $editing ? 'update_property' : 'save_property'; ?>">
          <?php if ($editing): ?><input type="hidden" name="property_id" value="<?php echo e($editing['id']); ?>"><?php endif; ?>
          <div class="col-md-6"><input name="title" class="form-control" placeholder="Title" value="<?php echo e($editing['title'] ?? ''); ?>" required></div>
          <div class="col-md-6"><input name="slug" class="form-control" placeholder="Slug" value="<?php echo e($editing['slug'] ?? ''); ?>" required></div>
          <div class="col-md-4"><select name="listing_type" class="form-select"><option value="sale" <?php echo (($editing['listing_type'] ?? '')==='sale')?'selected':''; ?>>Sale</option><option value="rent" <?php echo (($editing['listing_type'] ?? '')==='rent')?'selected':''; ?>>Rent</option><option value="short_stay" <?php echo (($editing['listing_type'] ?? '')==='short_stay')?'selected':''; ?>>Short stay</option></select></div>
          <div class="col-md-4"><select name="property_type" class="form-select"><option <?php echo (($editing['property_type'] ?? '')==='Apartment')?'selected':''; ?>>Apartment</option><option <?php echo (($editing['property_type'] ?? '')==='House')?'selected':''; ?>>House</option><option <?php echo (($editing['property_type'] ?? '')==='Penthouse')?'selected':''; ?>>Penthouse</option><option <?php echo (($editing['property_type'] ?? '')==='Condo')?'selected':''; ?>>Condo</option><option <?php echo (($editing['property_type'] ?? '')==='Loft')?'selected':''; ?>>Loft</option></select></div>
          <div class="col-md-4"><select name="status" class="form-select"><option value="draft" <?php echo (($editing['status'] ?? '')==='draft')?'selected':''; ?>>Draft</option><option value="review" <?php echo (($editing['status'] ?? '')==='review')?'selected':''; ?>>Review</option><option value="live" <?php echo (($editing['status'] ?? '')==='live')?'selected':''; ?>>Live</option><option value="pending" <?php echo (($editing['status'] ?? '')==='pending')?'selected':''; ?>>Pending</option></select></div>
          <div class="col-md-4"><input name="price" type="number" class="form-control" placeholder="Price" value="<?php echo e($editing['price'] ?? ''); ?>" required></div>
          <div class="col-md-4"><input name="bedrooms" type="number" class="form-control" placeholder="Bedrooms" value="<?php echo e($editing['bedrooms'] ?? ''); ?>"></div>
          <div class="col-md-4"><input name="bathrooms" type="number" class="form-control" placeholder="Bathrooms" value="<?php echo e($editing['bathrooms'] ?? ''); ?>"></div>
          <div class="col-md-4"><input name="area_sqft" type="number" class="form-control" placeholder="Area sqft" value="<?php echo e($editing['area_sqft'] ?? ''); ?>"></div>
          <div class="col-md-4"><input name="country" class="form-control" placeholder="Country" value="<?php echo e($editing['country'] ?? ''); ?>"></div>
          <div class="col-md-4"><input name="city" class="form-control" placeholder="City" value="<?php echo e($editing['city'] ?? ''); ?>"></div>
          <div class="col-md-6"><input name="neighborhood" class="form-control" placeholder="Neighborhood" value="<?php echo e($editing['neighborhood'] ?? ''); ?>"></div>
          <div class="col-md-6"><input name="address" class="form-control" placeholder="Address" value="<?php echo e($editing['address'] ?? ''); ?>"></div>
          <div class="col-md-6"><input name="latitude" class="form-control" placeholder="Latitude" value="<?php echo e($editing['latitude'] ?? ''); ?>"></div>
          <div class="col-md-6"><input name="longitude" class="form-control" placeholder="Longitude" value="<?php echo e($editing['longitude'] ?? ''); ?>"></div>
          <div class="col-12"><textarea name="description" class="form-control" rows="4" placeholder="Description"><?php echo e($editing['description'] ?? ''); ?></textarea></div>
          <div class="col-md-4"><input name="currency" class="form-control" value="<?php echo e($editing['currency'] ?? 'USD'); ?>" placeholder="Currency"></div>
          <div class="col-md-4 d-flex align-items-center"><div class="form-check"><input type="checkbox" name="featured" class="form-check-input" id="featured" <?php echo !empty($editing['featured']) ? 'checked' : ''; ?>><label class="form-check-label" for="featured">Featured</label></div></div>
          <div class="col-md-4"><input name="images[]" type="file" multiple class="form-control" accept="image/*"></div>
          <div class="col-12"><button class="btn btn-accent">Save property</button></div>
        </form>
      </div>
    </div>

    <div class="surface mb-4">
      <h4>My properties</h4>
      <div class="table-responsive mt-3">
        <table class="table table-dark table-hover align-middle">
          <thead><tr><th>Title</th><th>Status</th><th>Price</th><th>City</th><th>Action</th></tr></thead>
          <tbody>
            <?php foreach ($props as $p): ?>
            <tr>
              <td><?php echo e($p['title']); ?></td>
              <td><span class="badge badge-soft"><?php echo e($p['status']); ?></span></td>
              <td><?php echo e(money($p['price'])); ?></td>
              <td><?php echo e($p['city']); ?></td>
              <td class="d-flex gap-2">
                <a href="property.php?id=<?php echo e($p['id']); ?>" class="btn btn-sm btn-outline-light">View</a>
                <button class="btn btn-sm btn-outline-warning" data-toast="Use the form above to edit from your current implementation flow.">Edit</button>
                <form action="actions.php" method="post" onsubmit="return confirm('Delete this property?')">
                  <?php echo csrf_field(); ?><input type="hidden" name="action" value="delete_property"><input type="hidden" name="property_id" value="<?php echo e($p['id']); ?>"><button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="surface">
      <h4>Lead inbox</h4>
      <p class="text-secondary mb-0">Inquiry analytics, booking follow-up, and subscription management are connected through the schema and action handlers.</p>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
