<?php

$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the
    // Database Connection.
    include 'dbConnect.php';

    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];


    $sql = "Select * from Users where email='$email'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    // This sql query is use to check if
    // the username is already present
    // or not in our Database
    if ($num == 0) {
        if (($password == $cpassword) && $exists == false) {

            $hash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Password Hashing is used here.
            $sql = "INSERT INTO `Users` ( `email`, 
`password`, `date`) VALUES ('$email', 
'$hash', current_timestamp())";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    }// end if

    if ($num > 0) {
        $exists = "Username not available";
    }
    if ($showAlert) {
        header("location:./sping_wheel.php");
        die();
        # code...
    }

}//end if

?> 
<!doctype html> 
<html lang="en"> 

<head> 
<!-- Required meta tags --> 
<meta charset="utf-8"> 
<meta name="viewport" content= 
"width=device-width, initial-scale=1, 
shrink-to-fit=no"> 

<!-- Bootstrap CSS --> 
<link rel="stylesheet" href= 
"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
integrity= 
"sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
      crossorigin="anonymous"> 
  <link rel="stylesheet" href="src/btn_styles.css" />
  <link rel="stylesheet" href="src/top_nav.css" />
  <link rel="stylesheet" href="src/footer.css">
</head> 

<body> 

  <div class="topNav">
    <a href="#" class="slipt"><img src="https://template.viserlab.com/casinous/demo/assets/images/logo.png"
        alt="" /></a>
    <div class="right">
      <a href="./index.php">Home</a>
      <a href="about.php">About</a>
      <a href="#Games">Games</a>
    </div>
  </div>
<?php

if ($showError) {

    echo ' <div class="mt-5 alert alert-danger 
      alert-dismissible fade show" role="alert"> 
      <strong>Error!</strong> '. $showError.'

<button type="button" class="close"
data-dismiss="alert aria-label="Close"> 
<span aria-hidden="true">×</span> 
</button> 
</div> ';
}

if ($exists) {
    echo ' <div class="mt-5 alert alert-danger 
alert-dismissible fade show" role="alert"> 

<strong>Error!</strong> '. $exists.'
<button type="button" class="close"
data-dismiss="alert" aria-label="Close"> 
<span aria-hidden="true">×</span> 
</button> 
</div> ';
}

?> 

    <div class="container mt-5 my-4 col-4  
      d-flex flex-column justify-content-center   "> 
      <h1 class="text-center">Sign up</h1> 
      <form action="signup.php"  method="post" > 
        <div class="form-group"> 
          <label for="email">Username</label> 
            <input type="email" class="form-control" id="username" name="email" aria-describedby="emailHelp">	 
        </div> 
        <div class="form-group"> 
          <label for="password">Password</label> 
          <input type="password" class="form-control"
            id="password" name="password"> 
        </div> 
        <div class="form-group"> 
          <label for="cpassword">Confirm Password</label> 
          <input type="password" class="form-control" id="cpassword" name="cpassword"> 

          <small id="emailHelp" class="form-text text-muted"> 
            Make sure to type the same password 
          </small> 
        </div>	 
        <button type="submit" class="btn btn_action"> 
          Sign Up 
        </button> 
      </form> 
</div> 

  <footer>
    <div class="cont_">

      <div class="cont">
        <a href="#" class="slipt"><img src="https://template.viserlab.com/casinous/demo/assets/images/logo.png"
            alt="" /></a>
        <div class="right">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms &amp; Conditions </a>
          <a href="#Games">Games</a>
        </div>
      </div>
      <div class="copy">
        <a> Copyrights &copf; All Rights Reserved </a>
      </div>

    </div>

  </footer>
<!-- Optional JavaScript --> 
<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script> 

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
integrity= "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
crossorigin="anonymous"></script> 
<script src=" 
https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
crossorigin="anonymous"></script> 
</body> 
</html> 
