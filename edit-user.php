<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'validation/validation.php';
    include 'Database/Database.php';

    session_start();
   
    if(empty($_SESSION) || $_SESSION['role'] !== 1){
        header("Location:login-form.php");
    }
    // call validation and extract needed data
    $validations = validate();
    $formerrors = $validations["errors"];
    $oldvalues = $validations["formvalues"];
    $profile_name = $validations["profile_name"];
    $profile_tmp = $validations["profile_tmp"];

    // redirect to add form with errors and old data
    if($formerrors !== "[]"){
        $redirect_url = "Location:add-userForm.php?errors={$formerrors}";
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
            unlink($imagespath);
            sys_get_temp_dir();
            move_uploaded_file($profile_tmp,"images/users/{$profile_name}");
            $imagespath = "images/users/{$profile_name}";
        }

        // update data 
        try {
            // connect to database 
            $database = new Database();
            $db = $database -> connect();

            $id = $_GET['id'];
            
           
            if($imagespath)        
                $database -> update("User", $id,"username", "email","password", "room", "`profile-pic`",
                $_POST['name'], $_POST['email'], $_POST['password'],$_POST['room'], $imagespath);
            else 
                $database -> update( "users", $id,"name", "email","password", "room", 
                $_POST['name'], $_POST['email'], $_POST['password'],$_POST['room']);
           
            header("Location:users-table.php");
        } catch (Exception $e) {
            var_dump( $stmt->errorInfo());
            var_dump($e);
        }
    }

?>