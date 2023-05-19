<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../models/cart.php';
   
    include "../../guard/auth.php";
   
    auth("../../views/auth/login-form.php");

    $cart_id = $_GET["cart_id"];
    $product_id = $_GET["product_id"];
    $quantity = $_GET["quantity"];
    $cart = new Cart();

    $cart -> admin_add_Cart_Item($cart_id, $product_id,$quantity=1);
    header("Location:../../views/adminHome");
?>