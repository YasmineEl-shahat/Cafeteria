<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../validation/validation.php';
    include '../../models/user.php';

    session_start();
   
    if(empty($_SESSION) || $_SESSION['role'] !== 1){
        header("Location:../../views/auth/login-form.php");
    }
    // call validation and extract needed data
    $validations = validate();
    $formerrors = $validations["errors"];
    $oldvalues = $validations["formvalues"];
    $profile_name = $validations["profile_name"];
    $profile_tmp = $validations["profile_tmp"];

    // redirect to edit form with errors and old data
    if($formerrors !== "[]"){
        $id = $_GET['id'];
        $redirect_url = "Location:../../views/user/edit-form.php?errors={$formerrors}&id={$id}";
        if ($oldvalues !== "[]"){
            $oldvalues = json_encode($oldvalues);
            $redirect_url .="&old={$oldvalues}";
        }
        header($redirect_url);
    }
    else {
        // uploading image
        if($profile_name != ""){
            $imagespath = $_GET["imgPath"];
            if(file_exists( $imagePath))  unlink($imagespath);
            sys_get_temp_dir();
            move_uploaded_file($profile_tmp,"../../assets/images/users/{$profile_name}");
            $imagespath = "../../assets/images/users/{$profile_name}";
        }

        // update data 
        try {
            // connect to database 
            $database = new Database();
            $id = $_GET['id'];
            
            if($imagespath)        
                $database -> update("User", $id,"username", "email","password", "room", "`profile-pic`",
                $_POST['username'], $_POST['email'], $_POST['password'],$_POST['room'], $imagespath);
            else 
                $database -> update( "users", $id,"username", "email","password", "room", 
                $_POST['username'], $_POST['email'], $_POST['password'],$_POST['room']);
           
            header("Location:../../views/user/users-table.php");
        } catch (Exception $e) {
            var_dump( $stmt->errorInfo());
            var_dump($e);
        }
    }

?>