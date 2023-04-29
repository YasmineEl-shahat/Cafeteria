<?php
//include '../layout/navbar.php';
//include '../../models/Order.php';
//$order= new Order();
//var_dump($order->userOrders());

include '../../controllers/order/userOrders.php';

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
                <form class="">

                    <input type="date" name="from-date" class=" border rounded" style="width: 20%;height:40px">

                    <input type="date" name="to-date" class="border rounded ml-3" style="width: 20%;height:40px">

                    <button type="submit" class="border rounded ml-3 text-light" style="width: 15%;height:40px ;background-color:#c49b63">Search</button>
                </form>
                <div>
                    <table class="table mt-5 p-1 table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th >Order Date</th>
                                <th >Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-left">
                                <td ><i class="fas fa-plus " data-toggle="nested-table" data-target="#nested-div-2"></i>2020-02-01</td>
                                <td >processing</td>
                                <td >55 EGP</td>
                                <td >cancel</td>
                            </tr>
                            <tr class="text-left">
                            <td ><i class="fas fa-plus " data-toggle="nested-table" data-target="#nested-div-2"></i>2020-02-01</td>
                                <td >processing</td>
                                <td >55 EGP</td>
                                <td >cancel</td>
                            </tr>
                        </tbody>
                    </table>

                <div id="nested-div-2" class="nested-table table mt-5 p-1 table-bordered ">

                    <div class="row">
                        <div class="col-3 ">
                            <img class="w-100 h-75" src="../../assets/images/about.jpg"/>
                            <p>name</p>
                            <p>amount</p>
                        </div>
                    
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