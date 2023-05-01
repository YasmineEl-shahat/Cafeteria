<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../models/cart.php';
   
    include "../../guard/auth.php";
   
    auth("../../views/auth/login-form.php");

    $cart_id = $_GET["cart_id"];
    $product_id = $_GET["product_id"];

    $cart = new Cart();

    $cart -> remove_Cart_Item($cart_id, $product_id);
    header("Location:../../views/cart");
?>