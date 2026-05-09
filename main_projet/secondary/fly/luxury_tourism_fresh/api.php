<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data.php';
header('Content-Type: application/json; charset=utf-8');

function json_out($arr) { echo json_encode($arr, JSON_UNESCAPED_SLASHES); exit; }

$action = $_POST['action'] ?? $_GET['action'] ?? '';
if ($action === 'packages') {
    $packages = packages_all();
    ob_start();
    foreach ($packages as $p): ?>
      <div class="col-lg-4 col-md-6 reveal">
        <div class="card card-premium h-100">
          <div class="image-cover" style="background-image:url('<?php echo e($p['image']); ?>'); min-height: 320px;">
            <div class="overlay-content">
              <div class="d-flex justify-content-between align-items-start">
                <span class="badge-soft text-dark"><i class="fa-solid fa-suitcase-rolling"></i> <?php echo e($p['tag']); ?></span>
                <span class="badge-soft text-dark"><i class="fa-solid fa-star text-warning"></i> <?php echo e($p['rating']); ?></span>
              </div>
              <h4 class="mt-3 mb-1 fw-bold"><?php echo e($p['title']); ?></h4>
              <p class="mb-0"><?php echo e($p['location']); ?> • <?php echo e($p['days']); ?></p>
            </div>
          </div>
          <div class="card-body p-4">
            <p class="small-muted mb-3"><?php echo e($p['desc']); ?></p>
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold fs-4"><?php echo e($p['price']); ?></div>
                <div class="small text-secondary">per person</div>
              </div>
              <a href="booking.php?package=<?php echo (int)$p['id']; ?>" class="btn btn-lux">Book Now</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach;
    $html = ob_get_clean();
    json_out(['ok'=>true,'html'=>$html]);
}

if ($action === 'booking') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $package = trim($_POST['package'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $people = max(1, (int)($_POST['people'] ?? 1));
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $package === '' || $date === '') {
        json_out(['ok'=>false,'message'=>'Please fill all required fields.']);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        json_out(['ok'=>false,'message'=>'Please enter a valid email address.']);
    }
    $bookings = storage_read('bookings.json', []);
    $bookings[] = [
        'id' => next_id($bookings),
        'name' => $name,
        'email' => $email,
        'package' => $package,
        'date' => $date,
        'people' => $people,
        'message' => $message,
        'created_at' => date('Y-m-d H:i:s')
    ];
    storage_write('bookings.json', $bookings);
    json_out(['ok'=>true,'message'=>'Booking sent successfully. We will contact you shortly.']);
}

if ($action === 'login') {
    $email = trim($_POST['email'] ?? '');
    $password = (string)($_POST['password'] ?? '');
    foreach (users_all() as $user) {
        if (strcasecmp($user['email'], $email) === 0 && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            json_out(['ok'=>true,'message'=>'Login successful. Redirecting...','redirect'=>'index.php']);
        }
    }
    json_out(['ok'=>false,'message'=>'Invalid email or password.']);
}

if ($action === 'register') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = (string)($_POST['password'] ?? '');
    if ($name === '' || $email === '' || strlen($password) < 6) {
        json_out(['ok'=>false,'message'=>'Fill all fields and use a 6+ character password.']);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        json_out(['ok'=>false,'message'=>'Enter a valid email address.']);
    }
    foreach (users_all() as $u) {
        if (strcasecmp($u['email'], $email) === 0) {
            json_out(['ok'=>false,'message'=>'Email already exists.']);
        }
    }
    $users = users_all();
    $users[] = [
        'id' => next_id($users),
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'user'
    ];
    storage_write('users.json', $users);
    json_out(['ok'=>true,'message'=>'Registration successful. Please log in.','redirect'=>'login.php']);
}

json_out(['ok'=>false,'message'=>'Invalid request.']);
