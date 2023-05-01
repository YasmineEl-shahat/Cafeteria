<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "../../guard/auth.php";
    include '../../models/cart.php';
    include '../../models/order.php';
   
    auth("../../views/auth/login-form.php");

    $cart_id = $_GET["cart_id"];

    $order = new Order();
    $cart = new Cart();

    $order->insertorder("user_id", "status", $cart_id, "processing");
    $order_id = $order -> select_last_order_id();

    $items = $cart -> get_Cart_items($cart_id);

   

    var_dump($order_id);
    // header("Location:../../views/cart");
?>