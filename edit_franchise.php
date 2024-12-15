<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodiecorner";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch existing data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM franchise WHERE id=$id";
    $result = $conn->query($sql);
    $franchise = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $nationality = $_POST['nationality'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $notes = $_POST['notes'];
    
    $sql = "UPDATE franchise SET fname='$fname', lname='$lname', nationality='$nationality', mobile='$mobile', email='$email', firstname='$firstname', city='$city', country='$country', notes='$notes' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Franchise</title>
</head>
<body>
<div class="con1">
    <h2>Edit Franchise</h2>
    <div class="con1a">
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $franchise['id']; ?>">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo $franchise['fname']; ?>"><br>
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo $franchise['lname']; ?>"><br>
        <label for="nationality">Nationality:</label>
        <input type="text" name="nationality" value="<?php echo $franchise['nationality']; ?>"><br>
        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" value="<?php echo $franchise['mobile']; ?>"><br>
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $franchise['email']; ?>"><br>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $franchise['firstname']; ?>"><br>
        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo $franchise['city']; ?>"><br>
        <label for="country">Country:</label>
        <input type="text" name="country" value="<?php echo $franchise['country']; ?>"><br>
        <label for="notes">Notes:</label>
        <textarea name="notes"><?php echo $franchise['notes']; ?></textarea><br>
        <button class="btn-dark1" type="submit">Save</button>
    </form>
</div>
</div>
</body>
</html>
