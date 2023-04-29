<!-- write functio that validate form values -->
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
    $product_image = $_FILES['product_image']['name'];
    $product_tmp = $_FILES['product_image']['tmp_name'];
    $extension = explode('.',basename($product_image));
    $allowed_extenstions=["png", 'jpg', 'jpeg'];
    if($product_image != "" && !in_array(end($extension), $allowed_extenstions))  
        $errors["product_image"] = "invalid image";

    // encode errors to be passed into header
    $formerrors=json_encode($errors);

    $arr = ["errors"=>$formerrors, "formvalues"=>$formvalues, 
    "product_image"=>$product_image, "product_tmp"=>$product_tmp];
    return $arr;
}

?>