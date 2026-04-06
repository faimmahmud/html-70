<?php
// car.php ফাইলটি include করা (class ব্যবহার করার জন্য)
require_once('car.php');

// form submit হয়েছে কিনা check করা
if (isset($_POST['submit'])) {

    // form থেকে data নেওয়া
    $id = $_POST['id'];        // ID input থেকে value নেওয়া
    $name = $_POST['name'];    // Name input থেকে value নেওয়া
    $email = $_POST['email'];  // Email input থেকে value নেওয়া

    // Car class এর object তৈরি করা
    $car = new Car($id, $name, $email);

    // data file-এ save করা
    $car->saveData();

    // success message দেখানো
    echo "Data Saved Successfully<br><br>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Info</title> <!-- পেজের title -->
</head>
<body>

<!-- form তৈরি করা -->
<form method="post">
    
    ID: <br>
    <!-- number input (ID নেওয়ার জন্য) -->
    <input type="number" name="id" required><br><br>

    Name: <br>
    <!-- text input (Name নেওয়ার জন্য) -->
    <input type="text" name="name" required><br><br>

    Email: <br>
    <!-- email input (Email নেওয়ার জন্য) -->
    <input type="email" name="email" required><br><br>

    <!-- submit button -->
    <input type="submit" name="submit" value="Submit">
</form>

<hr>

<?php
// static method call করে সব data দেখানো
Car::showData();
?>

</body>
</html>