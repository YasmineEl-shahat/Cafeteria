<?php
    include '../../models/product.php';
    include "../../guard/adminAuth.php";
    adminAuth("../../views/auth/login-form.php");
    $product_id = $_GET['id'];
    ############################# Delete
    $product = new product();
    $imagePath = $product->select_product($product_id)["image"];
    if(file_exists( $imagePath) && is_file($imagePath)) unlink($imagePath);
    $product -> delete_product($product_id);
    header("Location:../../views/product/products-table.php");
?>