<?php



error_reporting(0);
require_once('dbconfig.php');

$fname =  $_REQUEST['fname'];
$lname =  $_REQUEST['lname'];
$nationality =  $_REQUEST['nationality'];
$mobile =  $_REQUEST['mobile'];
$email =  $_REQUEST['email'];
$firstname =  $_REQUEST['firstname'];
$city =  $_REQUEST['city'];
$country =  $_REQUEST['country'];
$notes =  $_REQUEST['notes'];

$sql = "INSERT INTO franchise(fname,lname,nationality,mobile,email,firstname,city,country,notes) VALUES('$fname','$lname','$nationality','$mobile','$email','$firstname','$city','$country','$notes')";


// Check if all required fields are filled
if (!empty($fname) && !empty($lname) && !empty($nationality) && !empty($mobile) && !empty($email) && !empty($firstname) && !empty($city) && !empty($country) && !empty($notes)) {

  // Create a database connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check if the connection is successful
  if ($conn === false) {
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  // Escape user inputs to prevent SQL injection
  $fname = mysqli_real_escape_string($conn, $fname);
  $lname = mysqli_real_escape_string($conn, $lname);
  $nationality = mysqli_real_escape_string($conn, $nationality);
  $mobile = mysqli_real_escape_string($conn, $mobile);
  $email = mysqli_real_escape_string($conn, $email);
  $firstname = mysqli_real_escape_string($conn, $firstname);
  $city = mysqli_real_escape_string($conn, $city);
  $country = mysqli_real_escape_string($conn, $country);
  $notes = mysqli_real_escape_string($conn, $notes);

  // Attempt to insert data
  $sql = "INSERT INTO franchise (fname, lname, nationality, mobile, email,firstname,city,country,notes) VALUES ('$fname', '$lname', '$nationality', '$mobile', '$email','$firstname','$city','$country','$notes')";
  if (mysqli_query($conn, $sql)) {
      echo "Records inserted successfully.";
  } else {
      echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
  }

  // Close the connection
  mysqli_close($conn);
} else {
  echo "Please fill all the fields.";
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie Corner</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/franchise.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<nav class="navbar navbar-expand-sm  navbar-light">
     
          <a class="navbar-brand" href="#"><img src="images/Asset 2@300x-8 1.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar1">
              <ul class="navbar-nav">
                  <li class="nav-item active">
                      <a class="nav-link" href="index.php">HOME</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="who.php">WHO ARE WE</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="location.php">OUR LOCATION</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="gallery.php">GALLERY</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="founder.php">FOUNDER DESK</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="franchise.php">FRANCHISE</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="contact.php">CONTACT US</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="login.php">LOGIN</a>
          </li>
        <li class="nav-item ">
          <a class="nav-link" href="#"><img src="images/Vector.png" alt=""></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><img src="images/Vector (1).png" alt=""></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><img src="images/Group 481.png" alt=""></a>
  </li>
              </ul>
              
          </div>
    
  </nav>

  <div class="con1">
    <img class="con01" src="images/Frame 2 (2).png" alt="">
    <h1>Be Your Own Boss,<br>Be Our Franchisee</h1>
  </div>

  <div class="con2">

        <div class="con2a">
        <h2>Vs Foodie Corner Franchise Application Form</h2>
        <hr>
        </div>


        <div class="con2b">
        <div class="container d-flex justify-content-center">
    <div class="contact px-5 py-5 w-100">
        
        
        <div class="con2c">
        <p>Personal Details</p>
        </div>
   <form action="franchise.php" method='post'>
        <div class="row">
            <div class="col-md-13"> <input type="text" name="fname" class="form-control" placeholder="First Name" /> </div>
        </div>
        <div class="row">
            <div class="col-md-13"> <input type="text" name="lname" class="form-control" placeholder="Last Name" /> </div>
        </div>
        <div class="row">
            <div class="col-md-13"> <input type="text" name="nationality" class="form-control" placeholder="Nationality" /> </div>
        </div>
        <div class="row">
            <div class="col-md-6"> <input type="text" name="mobile" class="form-control" placeholder="Mobile" /> </div>
            <div class="col-md-6"> <input type="text" name="email" class="form-control" placeholder="Enter Email" /> </div>
        </div>
        <div class="con5b2">
        </div>
        
        <div class="con2d">
        <p>Franchise Details</p>
        </div>
        <div class="row">
            <div class="col-md-13"> <input type="text" name="firstname" class="form-control" placeholder="First Name" /> </div>
        </div>
        <div class="row">
            <div class="col-md-6"> <input type="text"  name="city" class="form-control" placeholder="City" /> </div>
            <div class="col-md-6"> <input type="text" name="country" class="form-control" placeholder="Country" /> </div>
        </div>

        <div class="con2d">
        <p>FOR VS Foodie Corner</p>
        </div>
        <div class="row mt-3">
            <div class="col-md-12"> 
                <textarea rows="3" class="form-control" name="notes" placeholder="Notes"></textarea> 
            </div>
        </div>

        <div class="con5b2">
        <button class="btn-dark2" type="submit">Submit Form</button>
        </div>

    </div>
</div>
</form>
        </div>

        
<div class="con11">

<div class="blockcode">
 

  <footer class="page-footer shadow">
    <div class="d-flex flex-column mx-auto py-5" >
      <div class="d-flex flex-wrap justify-content-between">
        <div class="con11b">
          <a href="/" class="d-flex align-items-center p-0 text-dark">
            <img class="con11a" alt="logo" src="images/Asset 2@300x-8 1.png" />
          </a>
          <p class="my-3" >
          Satisfy your cravings for<br> deliciousness at VS Foodie Corner <br>- Where every dish is an exquisite<br>
           skillful creation.
          </p>
        </div>
        <div class="con11c">
          <p class="h5 mb-4" >ADDRESS</p>
          <ul class="p-0">
            <li class="my-2">
              <p class="text" href="/">58 Ralph Ave<br>
                  New York, New York 1111</p><br>
            </li>
            <li class="my-2">
              <p class="text" href="/">P: +1 800 000 111<br>
                E: contact@example.com</p>
            </li>
          </ul>
        </div>
        <div class="con11d">
          <p class="h5 mb-4">QUCIK LINKS</p>
          <ul class="p-0" >
            <li class="my-2">
              <a class="text" href="/">Home</a>
            </li>
            <li class="my-2">
              <a class="text" href="/">Who we are</a>
            </li>
            <li class="my-2">
              <a class="text" href="/">Our location</a>
            </li>
            <li class="my-2">
              <a class="text" href="/">Gallery</a>
            </li>
            <li class="my-2">
              <a class="text" href="/">Founder Desk</a>
            </li>
            <li class="my-2">
              <a class="text" href="/">Franchise</a>
            </li>
            <li class="my-2">
              <a class="text" href="/">Contact Us</a>
            </li>
          </ul>
        </div>
        <div class="con11e">
          <p class="h5 mb-4" >OPEN HOURS</p>
          <ul class="p-0" >
            <li class="my-2">
              <p class="text" href="/">Monday – Sunday<br>
                        Lunch: 12PM – 2PM<br>
                        Dinner: 6PM – 10PM<br><br>
              </p>
            </li>
            <li class="my-2">
              <p class="text" href="/">Happy Hours: 4PM – 6PM</p>
            </li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="con11f">
          <div class="con11f2">
          2023 © foodie corner.
          </div>
          <div class="con11f3">
          <img class="con11f4" src="images/Vector.png" alt="">
          <img class="con11f4" src="images/Vector (1).png" alt="">
          <img class="con11f4" src="images/Group 481.png" alt="">
          </div>
      </div>
    </div>
  </footer>

</div>



  </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>