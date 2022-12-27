<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $adhar = $_POST["adhar"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
  

    $existssql="SELECT * FROM `users` WHERE username='$username'";
    $result=mysqli_query($conn, $existssql);
    $numexistsRows =mysqli_num_rows($result);
    if($numexistsRows > 0){
        // $exists=true;
        $showError = "Username Alraedy exists";
    }
    else{
        // $exists=false;
    

    if ($password == $cpassword) {
        $sql = "INSERT INTO `users` (`username`,`phone`,`adhar`, `password`, `dt`) VALUES ('$username','$phone','$adhar','$password', current_timestamp());";



        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
    } else {
        $showError = "Password do not match ";
    }
}
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created and you can login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
    <?php
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong>' . $showError . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center">Signup to our website</h1>
        <form action="/Login System/signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Usernmae</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>

            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Enter a phone number:</label><br><br>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="" pattern="[0-9]{10}" required><br><br>
                <small></small>
            </div>
            <div class="mb-3">
                <label for="adhar" class="form-label">Enter Your Adhar number:</label><br><br>
                <input type="text" class="form-control" id="adhar" name="adhar" placeholder="" pattern="[0-9]{4}[0-9]{4}[0-9]{4}" required><br><br>
                <small></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"required>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Conform Password</label>
                <input type="password" class="form-control" id="cassword" name="cpassword"required>
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>

            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>

    </div>




    <!-- <h1>Hello, world!</h1> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>