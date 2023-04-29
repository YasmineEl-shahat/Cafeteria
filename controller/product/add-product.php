<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../validation/validation.php';
    include '../../models/product.php';
    include '../../models/category.php';

    include "../../guard/adminAuth.php";
   
    adminAuth("../../views/auth/login-form.php");
   
    // call validation and extract needed data
    // $validations = validate();
    // $formerrors = $validations["errors"];
    // $oldvalues = $validations["formvalues"];
    $product_image= $_FILES['product_image']['name'];
    $product_tmp = $_FILES['product_image']['tmp_name'];
    
    
    // redirect to add form with errors and old data
    // if($formerrors !== "[]"){
    //     $redirect_url = "Location:../../views/user/add-userForm.php?errors={$formerrors}";
    //     if ($oldvalues !== "[]"){
    //         $oldvalues = json_encode($oldvalues);
    //         $redirect_url .="&old={$oldvalues}";
    //     }
    //     header($redirect_url);
    // }
    // else {
        // uploading image
        sys_get_temp_dir();
        move_uploaded_file($product_tmp,"../../assets/images/products/{$product_image}");
        $imagespath = "../../assets/images/products/{$product_image}";
        // save data 
        $product = new Product();
        $categoryName = $_POST['category'];
        $category = new Category();
        var_dump($categoryName);
        $categoryId = $category->selectCategoryIdByName($categoryName);
        var_dump($categoryId);

        $product->insertProduct("name", "price", "image", "category_id",
            $_POST['name'], $_POST['price'], $imagespath, $categoryId);
        header("Location:../../views/product/products-table.php");
    // }
?>