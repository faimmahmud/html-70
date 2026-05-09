<?php
$pageTitle = 'Admin Panel | Aurelia Travel';
require_once __DIR__ . '/includes/header.php';
if (!is_admin()) {
    echo '<section class="section"><div class="container"><div class="alert alert-warning">Admin access required. <a href="login.php">Login here</a>.</div></div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$packages = packages_all();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_action'])) {
    $act = $_POST['admin_action'];
    $packages = packages_all();

    if ($act === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $image = trim($_POST['image'] ?? '');
        $uploaded = upload_image('upload_image');
        if ($uploaded) $image = $uploaded;

        $payload = [
            'title' => trim($_POST['title'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'price' => trim($_POST['price'] ?? ''),
            'rating' => (float)($_POST['rating'] ?? 0),
            'days' => trim($_POST['days'] ?? ''),
            'tag' => trim($_POST['tag'] ?? ''),
            'desc' => trim($_POST['desc'] ?? ''),
            'image' => $image
        ];
        if ($id > 0) {
            $packages = update_item($packages, $id, $payload);
            $msg = 'Package updated.';
        } else {
            $payload['id'] = next_id($packages);
            $packages[] = $payload;
            $msg = 'Package added.';
        }
        storage_write('packages.json', $packages);
    }

    if ($act === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $packages = delete_item($packages, $id);
        storage_write('packages.json', $packages);
        $msg = 'Package deleted.';
    }
}
$edit = null;
if (isset($_GET['edit'])) {
    foreach ($packages as $p) if ((int)$p['id'] === (int)$_GET['edit']) $edit = $p;
}
?>
<section class="section pt-4">
  <div class="container">
    <?php if ($msg): ?><div class="alert alert-success"><?php echo e($msg); ?></div><?php endif; ?>
    <div class="row g-4">
      <div class="col-lg-5">
        <div class="glass-card rounded-5 p-4 p-lg-5">
          <h3 class="fw-bold mb-3"><?php echo $edit ? 'Edit package' : 'Add package'; ?></h3>
          <form method="post" enctype="multipart/form-data" class="admin-grid">
            <input type="hidden" name="admin_action" value="save">
            <input type="hidden" name="id" value="<?php echo e($edit['id'] ?? ''); ?>">
            <input class="form-control" name="title" placeholder="Title" value="<?php echo e($edit['title'] ?? ''); ?>" required>
            <input class="form-control" name="location" placeholder="Location" value="<?php echo e($edit['location'] ?? ''); ?>" required>
            <div class="row g-2">
              <div class="col-6"><input class="form-control" name="price" placeholder="Price" value="<?php echo e($edit['price'] ?? ''); ?>" required></div>
              <div class="col-6"><input class="form-control" name="rating" placeholder="Rating" value="<?php echo e($edit['rating'] ?? ''); ?>" required></div>
            </div>
            <div class="row g-2">
              <div class="col-6"><input class="form-control" name="days" placeholder="Days" value="<?php echo e($edit['days'] ?? ''); ?>" required></div>
              <div class="col-6"><input class="form-control" name="tag" placeholder="Tag" value="<?php echo e($edit['tag'] ?? ''); ?>" required></div>
            </div>
            <textarea class="form-control" name="desc" rows="4" placeholder="Description" required><?php echo e($edit['desc'] ?? ''); ?></textarea>
            <input class="form-control" name="image" placeholder="Image URL" value="<?php echo e($edit['image'] ?? ''); ?>">
            <input class="form-control" type="file" name="upload_image" accept="image/*">
            <button class="btn btn-lux" type="submit"><?php echo $edit ? 'Update' : 'Save'; ?></button>
          </form>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="glass-card rounded-5 p-4 p-lg-5">
          <h3 class="fw-bold mb-3">Packages</h3>
          <div class="table-wrap">
            <table class="table align-middle">
              <thead><tr><th>Image</th><th>Title</th><th>Price</th><th>Actions</th></tr></thead>
              <tbody>
                <?php foreach ($packages as $p): ?>
                <tr>
                  <td><img src="<?php echo e($p['image']); ?>" alt="" style="width:88px;height:60px;object-fit:cover;border-radius:14px;"></td>
                  <td><?php echo e($p['title']); ?></td>
                  <td><?php echo e($p['price']); ?></td>
                  <td>
                    <a class="btn btn-sm btn-outline-primary" href="admin.php?edit=<?php echo (int)$p['id']; ?>">Edit</a>
                    <form method="post" class="d-inline" onsubmit="return confirm('Delete package?')">
                      <input type="hidden" name="admin_action" value="delete">
                      <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                      <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
