<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../models/cart.php';
   
    $id = $_GET["id"];
    var_dump($id);
    exit;
    
    // save data 
    $cart = new Cart();

    $cart -> update_Cart_Item($id, "quantity",$_POST['quantity'] );
    header("Location:../../views/cart");
?>