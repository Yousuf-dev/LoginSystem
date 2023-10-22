<?php
$showAlert = '';
$showError = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include 'partials/_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $exists = mysqli_query($conn, "Select * from users where username='$username'");
    $userExists = mysqli_num_rows($exists);
    if ($userExists > 0) {
        $showError = 'Username Already exists';
    } else {
        if ($password == $cpassword) {
            $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = 'Account Created Succcessfully';
            }
        } else {
            $showError = 'Passwords do not match';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php require 'partials/_nav.php' ?>
<?php
if ($showAlert != '') {
    echo '<div class="alert alert-success" role="alert">
                '.$showAlert.'</div>';
}
?>
<?php
if ($showError != '') {
    echo '<div class="alert alert-danger" role="alert">
                '.$showError.'
          </div>';
}
?>
<div class="container">
    <h2 class="text-center">Signup to our Website</h2>
    <form action="/loginsys/signup.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" id="user" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">Confirm Password</label>
            <input type="cpassword" class="form-control" id="cpassword" name="cpassword">
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>