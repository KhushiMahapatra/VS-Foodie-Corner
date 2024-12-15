<?php
// Start the session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location: dashboard.php");
    exit;
}

// Include the database configuration file
require_once "dbconfig.php";

$username = $pword = "";
$err = "";

// If request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if username and password are empty
    if (empty(trim($_POST['username'])) || empty(trim($_POST['pword']))) {
        $err = "Please enter username and password.";
    } else {
        $username = trim($_POST['username']);
        $pword = trim($_POST['pword']);
    }

    // If no errors, proceed with login
    if (empty($err)) {
        $sql = "SELECT id, username, pword FROM register WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($pword, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;
                            $sql = "INSERT INTO login (username, pword) VALUES ('$username', '$pword')";

                            // Redirect user to dashboard
                            header("location: dashboard.php");

                            exit;
                        } else {
                            // Invalid password
                            $err = "Invalid password.";
                        }
                    }
                } else {
                    // No account found with that username
                    $err = "No account found with that username.";
                }
            } else {
                // Statement execution failed
                $err = "Something went wrong. Please try again later.";
            }

            $stmt->close();
        } else {
            // Statement preparation failed
            $err = "Something went wrong. Please try again later.";
        }
    }

    // Display error if any
    if (!empty($err)) {
        echo "<div class='alert alert-danger' role='alert'>$err</div>";
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie Corner</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
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
                <a class="nav-link" href="registration.php">Register</a>
            </li>
        </ul>
    </div>
</nav>

<div class="con2">
<div class="container">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="pword" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" required>
        </div>
        <button type="submit" class="btn-dark1 ">Submit</button>
    </form>
</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
