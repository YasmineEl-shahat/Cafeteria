<?php
include '../layout/navbar.php';
include '../../models/Order.php';
$order= new Order();
// var_dump($order->allUsersOrders());
?>
<section class="ftco-section ">
    <div class="container mt-5">
        <div class="row block-9">
            <div class="col-md-12 ftco-animate">

                <p class="h2">Checks</p>
                <div>
                    <label class="" style="width: 20%;">From Date:</label>
                    <label style="width: 20%;" class="ml-3">To Date:</label>
                    <label style="width: 20%;" class="ml-3">User Name:</label>
                </div>
                <form class="">

                    <input type="date" name="from-date" class=" border rounded" style="width: 20%;height:40px">

                    <input type="date" name="to-date" class="border rounded ml-3" style="width: 20%;height:40px">

                    <select id="exampleFormControlSelect1" class=" border rounded ml-3 " style="width: 20%;height:40px">
                        <option>User Name</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <button type="submit" class="border rounded ml-3 text-light" style="width: 15%;height:40px ;background-color:#c49b63">Search</button>
                </form>
                <div>
                    <table class="table mt-5 p-1 table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th >Name</th>
                                <th >Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-left">
                                <td ><i class="fas fa-plus " data-toggle="nested-table" data-target="#nested-table-1"></i>Mariam</td>
                                <td >2</td>
                            </tr>
                            <tr class="text-left">
                                <td ><i class="fas fa-plus" data-toggle="nested-table" data-target="#nested-table-1"></i>Habiba</td>
                                <td >2 </td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="nested-table-1" class="table nested-table mt-5 p-1 table-bordered">
                        <thead class="thead-primary">
                            <tr >
                            <th >Order Date</th>
                            <th >Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-left">
                                <td><i class="fas fa-plus" data-toggle="nested-table" data-target="#nested-div-2"></i>2020-02-22</td>
                                <td>300</td>
                            </tr>
                            <tr class="text-left">
                                <td><i class="fas fa-plus" data-toggle="nested-table" data-target="#nested-div-2"></i>2000-02-22</td>
                                <td>300</td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="nested-div-2" class="nested-table table mt-5 p-1 table-bordered">


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