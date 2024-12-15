<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodiecorner";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from contact
$sql_contact = "SELECT id, fname, lname, mobile, email, yourmessage FROM contact";
$result_contact = $conn->query($sql_contact);

// SQL query to fetch data from franchise
$sql_franchise = "SELECT id, fname, lname, nationality, mobile, email, firstname, city, country, notes FROM franchise";
$result_franchise = $conn->query($sql_franchise);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie Corner</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top:30px;
        }
        table, th, td {
            border: 1px solid white;
           
        }
        th, td {
            padding: 8px;
            text-align: left;
            
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="asset"> <a><img src="images/Asset 2@300x-8 1.png" alt=""></a></div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="con1">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
</div>

<div class="con2">
    <h1>Contact List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Your Message</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result_contact->num_rows > 0) {
            // Output data of each row
            while($row = $result_contact->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["fname"]. "</td>
                        <td>" . $row["lname"]. "</td>
                        <td>" . $row["mobile"]. "</td>
                        <td>" . $row["email"]. " </td>
                        <td>" . $row["yourmessage"]. "</td>
                        <td>
                <a href='edit_contact.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete_contact.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
            </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }
        ?>
    </table>
</div>

<div class="con3">
    <h1>Franchise List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Nationality</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>First Name</th>
            <th>City</th>
            <th>Country</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result_franchise->num_rows > 0) {
            // Output data of each row
            while($row = $result_franchise->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["fname"]. "</td>
                        <td>" . $row["lname"]. "</td>
                        <td>" . $row["nationality"]. "</td>
                        <td>" . $row["mobile"]. "</td>
                        <td>" . $row["email"]. " </td>
                        <td>" . $row["firstname"]. "</td>
                        <td>" . $row["city"]. "</td>
                        <td>" . $row["country"]. "</td>
                        <td>" . $row["notes"]. "</td>
                        <td>
                <a href='edit_franchise.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete_franchise.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
            </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No results found</td></tr>";
        }
        ?>
    </table>
</div>

<?php
$conn->close();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
