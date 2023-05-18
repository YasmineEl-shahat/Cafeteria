<?php
include '../layout/navbar.php';
include '../../models/Order.php';

$order= new Order();


// Check if a date filter has been submitted
if (isset($_GET['from-date']) && $_GET['from-date'] != '' && isset($_GET['to-date']) && $_GET['to-date'] != '' ) {
    $from_date = $_GET['from-date'];
    $to_date = $_GET['to-date'];

    $orders = $order->userOrdersSearchByDate($from_date, $to_date);
} else {
    // Return all data by default
    $orders = $order->userOrders();
}
?>
<section class="ftco-section ">
    <div class="container mt-5">
        <div class="row block-9">
            <div class="col-md-12 ftco-animate">

                <p class="h2">My Orders</p>
                <div>
                    <label class="" style="width: 20%;">From Date:</label>
                    <label style="width: 20%;" class="ml-3">To Date:</label>
                </div>
                <form class="" method="get">

                    <input type="date" name="from-date" class=" border rounded" style="width: 20%;height:40px">

                    <input type="date" name="to-date" class="border rounded ml-3" style="width: 20%;height:40px">

                    <button type="submit" class="border rounded ml-3 text-light"
                        style="width: 15%;height:40px ;background-color:#c49b63">Search</button>
                </form>
                <div>
                    <table class="table mt-5 p-1 table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
//                            $orderItems= $order->userOrderItem(1);
                            foreach ($orders as $order) {
                                echo "<tr class='text-left'>
                                  <td><i class='fas fa-plus' data-toggle='nested-table' data-target='#nested-div-{$order['order_id']}'></i>{$order['order_date']}</td>
                                  <td>{$order['order_status']}</td>
                             ";

                                if($order['order_status']=='proccessig') {
                                        $delete_url = "../../controller/order/delete-order.php?order_id={$order['order_id']}";
                                        echo "<td> <a href='" . "{$delete_url}" . "' class='btn btn-light'>Cancel</a> </td>";

                                    }
                            else
                                echo"<td >-</td>";
                            echo "</tr>";
                        }?>
                        </tbody>
                    </table>


        <!--order items-->
             <?php foreach($orders as $order) {
              echo "<div id='nested-div-{$order['order_id']}' class='nested-table table mt-5 p-1 table-bordered  '>" ;

            foreach($order['order_items'] as $item) {
                echo "<div class='row d-flex flex-row justify-content-around my-1'>
                        <div class='col-3' >
                            <img class='w-100 h-75' src='../../assets/images/about.jpg'/>
                          
                            <p class='my-1 font-weight-bold'>price: {$item['item_price']}</p>
                            <p class='my-1 font-weight-bold'>quntity: {$item['item_quantity']}</p>
                        </div></div>  ";}
            echo "   </div> ";

                     }
                    ?>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>



<?php
include '../layout/footer.php';
?>