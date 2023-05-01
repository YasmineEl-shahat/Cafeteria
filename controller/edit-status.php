<?php
$old_val = $_GET['status'];
if ($old_val == 'processing') {
    $new_val = 'outForDelivery';
} elseif ($old_val == 'outForDelivery') {
    $new_val = 'done';
} else {
    $new_val = 'done';
}
$id = $_GET['id'];
include "../models/order.php";
$order = new Order();
$order->update_order($id, 'status', $new_val);
header("location:../views/order/admin-orders.php");
