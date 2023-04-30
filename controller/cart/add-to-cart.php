<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../models/cart.php';
   
    $cart_id = $_GET["cart_id"];
    $product_id = $_GET["product_id"];

    // save data 
    $cart = new Cart();

    $cart -> add_Cart_Item($cart_id, $product_id);
    header("Location:../../views/home");
?>