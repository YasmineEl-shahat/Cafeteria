<?php
$id = $_GET['id'];
include "../models/order.php";
$order = new Order();
$data = $order->select_order($id);
$statuses = ['new', 'processing', 'outForDelivery', 'done'];
$status = $data['status'];
$index = array_search($status, $statuses);
if(count($statuses) - 1 == $index) {
    header("location:../views/order/admin-orders.php");
}
$new_status = $statuses[$index + 1];
$order->update_order($id,'status', $new_status);

header("location:../views/order/admin-orders.php");
