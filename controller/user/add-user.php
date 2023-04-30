<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../validation/validation.php';
    include '../../models/user.php';
    include '../../models/cart.php';

    include "../../guard/adminAuth.php";
   
    adminAuth("../../views/auth/login-form.php");
   
    // call validation and extract needed data
    $validations = validate();
    $formerrors = $validations["errors"];
    $oldvalues = $validations["formvalues"];
    $profile_name = $validations["profile_name"];
    $profile_tmp = $validations["profile_tmp"];
    
    
    // redirect to add form with errors and old data
    if($formerrors !== "[]"){
        $redirect_url = "Location:../../views/user/add-userForm.php?errors={$formerrors}";
        if ($oldvalues !== "[]"){
            $oldvalues = json_encode($oldvalues);
            $redirect_url .="&old={$oldvalues}";
        }
        header($redirect_url);
    }
    else {
        // uploading image
        sys_get_temp_dir();
        move_uploaded_file($profile_tmp,"../../assets/images/users/{$profile_name}");
        $imagespath = "../../assets/images/users/{$profile_name}";
        // save data 
        $user = new User();
        $user -> insertUser("username", "email","password", "room", "`profile-pic`", "is_admin",
                    $_POST['username'], $_POST['email'], $_POST['password'],$_POST['room'], $imagespath, 0);
        $user_id = $user->select_item_email($_POST['email'])->id;
        $cart = new Cart();
        $cart->insertCart("user_id",$user_id);
        header("Location:../../views/user/users-table.php");
    }
?>