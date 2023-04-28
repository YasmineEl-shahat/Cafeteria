<?php

    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../models/user.php';


    session_start();
   
    if(empty($_SESSION) || $_SESSION['role'] !== 1){
        header("Location:../../views/auth/login-form.php");
    }

    $user_id = $_GET['id'];

    ############################# Delete

    $user = new User();

    $imagePath = $user->select_user($user_id)["profile-pic"];

    if(file_exists( $imagePath)) unlink($imagePath);

    $user -> delete_user($user_id);

    header("Location:../../views/user/users-table.php");
?>