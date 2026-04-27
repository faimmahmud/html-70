<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$uploadMessage = "";

// Upload
if (isset($_POST["upload"])) {

    $file = $_FILES["file"];
    $filename = time() . "_" . $file["name"];
    $filesize = $file["size"];
    $tmp = $file["tmp_name"];

    $minSize = 400 * 1024; // 400 KB minimum

    if ($filesize < $minSize) {
        $uploadMessage = "❌ File too small! Minimum 400 KB required.";
    } else {

        if (!is_dir("uploads")) {
            mkdir("uploads");
        }

        move_uploaded_file($tmp, "uploads/" . $filename);
        $uploadMessage = "✅ Image uploaded successfully!";
    }
}
?>

<h2>Welcome <?php echo $_SESSION["user"]; ?></h2>

<a href="logout.php">Logout</a>

<!-- Upload Form -->
<form method="POST" enctype="multipart/form-data">
    <h3>Upload Image (Min 400 KB)</h3>
    <input type="file" name="file" accept="image/*" required><br><br>
    <button type="submit" name="upload">Upload</button>
</form>

<p><?php echo $uploadMessage; ?></p>

<hr>

<h3>Uploaded Images</h3>

<div style="display:flex; flex-wrap:wrap; gap:10px;">
<?php
$dir = "uploads";

if (is_dir($dir)) {
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {

            $path = "uploads/" . $file;

            echo "
                <div style='border:1px solid #ccc; padding:10px;'>
                    <img src='$path' width='150' height='150' style='object-fit:cover;'><br>
                    <a href='$path' target='_blank'>Open</a>
                </div>
            ";
        }
    }
} else {
    echo "No images uploaded yet.";
}
?>
</div>