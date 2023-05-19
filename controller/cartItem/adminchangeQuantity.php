<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../models/cart.php';
   
    $cart_id = $_POST['id'];
    $new_quantity = $_POST['quantity'];
   $userID = $_POST["user_id"];
    
    // save data 
    $cart = new Cart();

    $cart -> update_Cart_Item($cart_id, "quantity",$new_quantity);
    header("Location:../../views/order/cart.php?user_id=".$userID );
?>