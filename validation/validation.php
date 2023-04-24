<?php
function validate(){
    # validate data 
    $errors = [];
    $formvalues = [];
    foreach ($_POST as $k=>$value){
        if(!isset($k) or empty($value))
            $errors[$k] = $k." is required";
        else $formvalues[$k] = $value;    
    }
    
    // image validation 
    $profile_name = $_FILES['profile-pic']['name'];
    $profile_tmp = $_FILES['profile-pic']['tmp_name'];
    $extension = explode('.',basename($profile_name));
    $allowed_extenstions=["png", 'jpg', 'jpeg'];
    // if($profile_name == "")  $errors["profile-pic"] = "profile picture is required";
    if($profile_name != "" && !in_array(end($extension), $allowed_extenstions))  
        $errors["profile-pic"] = "invalid image";

    // mail and pass validation
    $mail_pattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
    $pass_pattern = "/^(?=.*\d)(?=.*[a-z])[0-9a-z]{8}$/";
    // if(!preg_match($mail_pattern, $_POST["email"])) $errors["email"] = "invalid mail";
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) $errors["email"] = "invalid mail format";
    if(!preg_match($pass_pattern, $_POST["password"])) 
        $errors["password"] = "password should be only 8 chars, nums";
    if($_POST["password"] !== $_POST["confirm-password"])
        $errors["confirm-password"] = "passwords should match";

    // encode errors to be passed into header
    $formerrors=json_encode($errors);

    $arr = ["errors"=>$formerrors, "formvalues"=>$formvalues, 
    "profile_name"=>$profile_name, "profile_tmp"=>$profile_tmp];
    return $arr;
}
