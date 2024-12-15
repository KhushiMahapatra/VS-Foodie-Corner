<?php
    $username = "root";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $password = "";
    $dbname = "foodiecorner";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and hash the password
    $username = $conn->real_escape_string($_POST['username']);
    $pword = password_hash($_POST['pword'], PASSWORD_BCRYPT);

    // Insert user into the database
    $sql = "INSERT INTO register (username, pword) VALUES ('$username', '$pword')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
        header("location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie Corner</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registration.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <a class="nav-link" href="login.php">Login</a>
            </li>
        </ul>
    </div>
</nav>

<div class="con2">
    <h2>Register</h2>
    <form class="con02" action="registration.php" method="post">
        <label class="con2a" for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <label class="con2b" for="password">Password</label>
        <input type="password" id="pword" name="pword"placeholder="Password" required><br>
        <input class="btn-dark1" type="submit" value="Register">
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>