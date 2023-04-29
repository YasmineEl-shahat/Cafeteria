<?php
    include '../../validation/validation.php';
    include '../../models/product.php';
    include '../../models/category.php';
    include "../../guard/adminAuth.php";
   
    adminAuth("../../views/auth/login-form.php");
    $errors = [];
    $formvalues = [];
    $id=$_GET['id'];
    foreach ($_POST as $k=>$value){
        if(!isset($k) or empty($value))
            $errors[$k] = $k." is required";
        else $formvalues[$k] = $value;    
    }

    if(count($errors) > 0){
        $errors = json_encode($errors);
        $redirect_url= "../../views/product/edit-form.php?errors={$errors}&id={$id}";
        header("Location: $redirect_url");
        exit();
    }
    $product_image= $_FILES['product_image']['name'];
    $product_tmp = $_FILES['product_image']['tmp_name'];
    $categoryName=$_POST['category'];
    $product = new Product();
    $category=new Category();
    $category_id=$category->selectCategoryIdByName($categoryName);
    
    if($product_image != ""){
        $product_image = "../../assets/images/products/{$product_image}";
        move_uploaded_file($product_tmp,"../../assets/images/products/{$product_image}");
        $product->update_product($_GET['id'],"name", "price", "image","availability", "category_id",
            $_POST['name'], $_POST['price'], $product_image,$_POST['availability'], $category_id);
            header("Location:../../views/product/products-table.php");
    }
    else{
        $product->update_product($_GET['id'],"name", "price", "category_id","availability",
        $_POST['name'], $_POST['price'], $category_id,$_POST['availability']);
        header("Location:../../views/product/products-table.php");
    }
    
    
    ?>