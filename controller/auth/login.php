<?php

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<div class='container fs-5' >  ";

include '../../models/user.php';

$email = $_POST["email"];
$password = $_POST["password"];

$user = new User();

$user = $user -> select_item_email($email);


if(!$user){
    $error = "email not found";
    $error=json_encode($error);
    $redirect_url = "Location:../../views/auth/login-form.php?error={$error}";
    header($redirect_url);
}
else if($user['password'] !== $password){
    $error = "invalid password";
    $error=json_encode($error);
    $redirect_url = "Location:../../views/auth/login-form.php?error={$error}";
    header($redirect_url);
}
else {
    session_start();
    $_SESSION["username"]=$user['username'];
    $_SESSION["role"]=$user['is_admin'];
    header("Location:../../views/homepage.php");
}




