<?php
include '../layout/navbar.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../../guard/adminAuth.php";

adminAuth("../auth/login-form.php");

if ($_GET) {
    $errors = json_decode($_GET['errors']);
    $old = json_decode($_GET['old']);
    $errors = (array) $errors;
    $oldValues = (array) $old;
} else $oldValues = [];
?>

<!-- cdn fontAwesome v 6.4.0  -->
<section class="ftco-section ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Orders</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Order Client</th>
                            <th>Order Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // include '../../models/order.php';
                        include '../../models/order.php';
                        $db = new Order();
                        // $con = $db->connect('cafeteria', 'php_nabila', 'Aa123456');
                        $orders = $db->get_users_orders();
                        var_dump($orders);
                        // $con = $db->connect('cafeteria', 'php_nabila', 'Aa123456');
                        // $orders = $db->select($con, 'cafeteria', 'order')->where('status', '==', 'proccessig')->get();
                        foreach ($orders as $order) {
                        echo '<tr>';
                        echo '<td style="vertical-align:top;>' . $order->id . '</td>';
                        echo '<td style="vertical-align:top;>' . $order->date_created . '</td>';
                        echo '<td style="vertical-align:top;>' . $order->status . '</td>';
                        echo '<td style="vertical-align:top;>' . $order->room . '</td>';

                        echo '<td> <table><tr>';

                        $items = $db->get_order_items($order->id);
                        foreach ($items as $item) {
                        // echo '<td>' .

                        // $product->name . ' - ' .
                        // $item->quantity . ' - ' .
                        // '</td>';../../assets/images/menu-1.jpg
                        echo '<td style="padding-top:0px; border:0">
                            
                                    <img class="img" style=" width:150px; height:150px;" src="'. $item->image.'"></img>
                                    <div class="text text-center pt-4">
                                        <h4>'. $item->name.'</h3>
                                        <p class="price">Quantity: <span>'. $item->quantity.'</span></p>
                                       </div>
                                </td>';
                        // echo '<td style="padding-top:0px;">
                                
                        //                 <img class="img" style=" width:150px; height:150px;" src="../../assets/images/menu-1.jpg"></a>
                        //                 <div class="text text-center pt-4">
                        //                     <h4>Coffee Capuccino</h3>
                        //                     <p class="price">Quantity: <span>5</span></p>
                        //                    </div>
                        //             </td>';
                        
                        }
                        echo '</tr></table></td>';
                        // echo '<td><a href="order-details.php?id=' . $order->id . '">Done</a></td>';
                        echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>