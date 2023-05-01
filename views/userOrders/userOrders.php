<?php
include '../layout/navbar.php';
include '../../models/Order.php';

$order= new Order();
//$orders =$order->userOrders();
//if(isset($_GET['orders'])){
//    $orders=json_decode($_GET['orders']);
//    var_dump($orders);
//}else{
//    $orders =$order->userOrders();}
//include '../../controllers/order/userOrders.php';




///////////////////////////////////////////

// Check if a date filter has been submitted
if (isset($_GET['from-date'])&& isset($_GET['to-date']) && $_GET['from-date'] != "" && $_GET['to-date'] != "") {
    $fromDate = $_GET['from-date'];
    $toDate = $_GET['to-date'];
    // Filter the data by the specified date
    $orders = $order->userOrdersSearch($fromDate, $toDate);
} else {
    // Return all data by default
    $orders =  $order->userOrders();
//    var_dump($orders);
//    exit;
//    $orderItems= $order->userOrderItem();
//    var_dump($orderIrems);
//    exit;
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
                            $orderItems= $order->userOrderItem(1);
                            foreach ($orders as $order) {


                            echo "<tr class='text-left'>
                            <td ><i class='fas fa-plus' data-toggle='nested-table' data-target='#nested-div'></i>$order->date_created</td>
                                <td >$order->status</td>
                          ";

                                if($order->status=='proccessig')
                                echo"<td ><a class=' btn btn-light' href=''>cancel</a></td>";
                                else
                                echo"<td >-</td>";
                            echo "</tr>";
                        }?>
                        </tbody>
                    </table>

                    <div id='nested-div' class='nested-table table mt-5 p-1 table-bordered '>

                        <?php foreach($orderItems as $order) {
//                   echo "<div id='nested-div-$order->id' class='nested-table table mt-5 p-1 table-bordered '>" ;


                    echo "<div class='row'>
                        <div class='col-3' >
                            <img class='w-100 h-75' src='../../assets/images/about.jpg'/>
                            <p>$order->id **</p>
                            <p>$order->price</p>
                            <p>$order->quantity</p>
                        </div> </div>      ";
                     }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>



<?php
include '../layout/footer.php';
?>