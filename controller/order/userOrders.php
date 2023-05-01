<?php

include '../../models/Order.php';

//include "../../guard/adminAuth.php";
//
//adminAuth("../../views/auth/login-form.php");

$order= new Order();
if(isset($_POST['from-date'])&&isset($_POST['to-date']) && $_POST['from-date']!=""&&$_POST['to-date']!=""){
    $fromDate=$_POST['from-date'];
    $toDate=$_POST['to-date'];
    $orders =$order->userOrdersSearchByDate($fromDate,$toDate);
//    var_dump($orders);
//    exit;
    $orders = json_encode($orders);
    header("Location:../../views/userOrders/userOrders.php?orders={$orders}");
}else{
    $orders =$order->userOrders();
//    exit;
    $orders = json_encode($orders);
    header("Location:../../views/userOrders/userOrders.php?orders={$orders}");
}