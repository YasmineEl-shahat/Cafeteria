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
    $order_id = $order -> select_last_order_id()[0]->id;

    $items = $cart -> get_Cart_items($cart_id);

    foreach($items as $item){
       
        $order -> insert_order_item("order_id", "product_id","quantity","price",
        $order_id, $item->product_id,$item -> quantity, $item->price);
    }

    $cart->clear_cart($cart_id);
    header("Location:../../views/cart");
?>