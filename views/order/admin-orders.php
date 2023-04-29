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
include '../../models/order.php';
$db = new Order();
// function markOrderAsDone($orderId) {
//     $db = new Order();
//     $db->mark_order_as_done($orderId);
// }   
?>

<!-- cdn fontAwesome v 6.4.0  -->
<section class="ftco-section ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Orders</h1>
                <table class="table table-order">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #dee2e6;">Order Client</th>
                            <th>Order Date</th>
                            <th>Order Room</th>
                            <th>Order Status</th>
                            <th>Done</th>
                            <!-- <th>Order Items</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // include '../../models/order.php';
                        // $db = new Order();
                        $orders = $db->get_users_orders();
                        foreach ($orders as $order) {
                            echo '<tr>';
                            echo '<td style="vertical-align:top;">' . $order->client . '</td>';
                            echo '<td style="vertical-align:top;">' . $order->date_created . '</td>';
                            echo '<td style="vertical-align:top;">' . $order->room . '</td>';
                            echo '<td style="vertical-align:top;">' . $order->status . '</td>';
                            // echo '<td><a href="#" onclick="' . $db->mark_order_as_done($order->id) . '" value="HIIIIII""></a></td>';
                            // $delete_url = "../../models/order.php";
                            // echo "<td> <a href='" . "{$delete_url}" . "' class='btn btn-danger'> Delete </a></td>";

                            $items = $db->get_order_items($order->id);
                            echo '</tr>';

                            echo '<tr>';
                            foreach ($items as $item) {
                                echo '<td>
                                <img class="img" style="width:150px; height:150px;" src="' . $item->image . '"></img>
                                <div class="text text-center pt-4">
                                    <h4>' . $item->name . '</h4>
                                    <p class="price">Quantity: <span>' . $item->quantity . '</span></p>
                                </div>
                                </td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
<script>
    // Redirect to a new location
    window.location.href = "http://example.com/new-location.php";
</script>