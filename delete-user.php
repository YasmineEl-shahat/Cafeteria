<?php

    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'Database/Database.php';

    $user_id = $_GET['id'];

    ############################# Delete

    $database = new Database();
    $db = $database -> connect("phplab4", "root", "asd5693");
    $imagePath = $database->select_item($db ,"phplab4", "users", $user_id)["profile-pic"];
    unlink($imagePath);
    $database -> delete($db ,"phplab4", "users", $user_id);

    header("Location:users-table.php");
?>