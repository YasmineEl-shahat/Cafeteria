<?php
include '../layout/navbar.php';
include '../layout/home-slider.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Orders</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <!-- <th>Order Date</th>
                        <th>Order Status</th> -->
                        <th>Order Items</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $con = $db->connect('cafeteria', 'php_nabila', 'Aa123456');
                    // $orders = $db->select($con, 'cafeteria', 'order')->where('status', '==', 'proccessig')->get();
                    // foreach ($orders as $order) {
                        echo '<tr>';
                        // echo '<td>' . $order->id . '</td>';
                        // echo '<td>' . $order->created_at . '</td>';
                        // echo '<td>' . $order->status . '</td>';
                        echo '<td>test </td>';
                        // $order_items = $db->select($con, 'cafeteria', 'order_item')->where('order_id', '==', $order->id)->get();
                        // foreach ($order_items as $item) {
                        // $product = $db->select($con, 'cafeteria', 'product', $item->product_id)->get();
                        echo '<td> <table><tr>';
                        // foreach ($order_items as $item) {
                        echo '<td> hi' .

                            // $product->name . ' - ' .
                            // $item->quantity . ' - ' .
                            '</td>';
                            echo '<td>de++++ </td>';
                            echo '<td>de </td>';
                        // }
                        echo '</tr></table></td>';
                        // }
                        // echo '<td><a href="order-details.php?id=' . $order->id . '">Done</a></td>';
                        echo '</tr>';
                    // }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../layout/footer.php';
?>