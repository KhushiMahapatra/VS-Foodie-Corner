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
    $sql = "SELECT * FROM contact WHERE id=$id";
    $result = $conn->query($sql);
    $contact = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $yourmessage = $_POST['yourmessage'];
    
    $sql = "UPDATE contact SET fname='$fname', lname='$lname', mobile='$mobile', email='$email', yourmessage='$yourmessage' WHERE id=$id";
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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie Corner</title>
    <link rel="stylesheet" href="css/edit_contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
    <div class="con1">
    <h1>Edit Contact</h1>
    <div class="con1a">
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
        <label for="fname">First Name :</label>
        <input type="text" name="fname" value="<?php echo $contact['fname']; ?>"><br><br>
        <label for="lname">Last Name :</label>
        <input type="text" name="lname" value="<?php echo $contact['lname']; ?>"><br><br>
        <label for="mobile">Mobile :</label>
        <input type="text" class="con2" name="mobile" value="<?php echo $contact['mobile']; ?>"><br><br>
        <label for="email">Email :</label>
        <input type="text" class="con2a"name="email" value="<?php echo $contact['email']; ?>"><br><br>
        <label for="yourmessage">Your<br>Message :</label>
        <textarea name="yourmessage"><?php echo $contact['yourmessage']; ?></textarea><br><br>
        <button class="btn-dark1"type="submit">Save</button>
    </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
</body>
</html>
