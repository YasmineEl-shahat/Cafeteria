<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include '../../models/category.php';

    include "../../guard/adminAuth.php";
   
    adminAuth("../../views/auth/login-form.php");
        // save data 
        if($_POST['name'] == "") {
            $redirect_url= "../../views/category/add-categoryForm.php?errors={$formvalues}";
            header("Location: $redirect_url");
        }
        $category = new Category();
        $category->insertCategory("name",
            $_POST['name']);
        header("Location:../../views/product/add-productForm.php");
    // }
?>