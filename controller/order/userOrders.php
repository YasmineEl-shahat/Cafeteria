<?php

include '../../models/Order.php';

include "../../guard/adminAuth.php";

adminAuth("../../views/auth/login-form.php");

$order= new Order();
//var_dump($order()->userOrders());