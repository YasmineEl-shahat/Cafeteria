<?php
include "../../guard/adminAuth.php";

adminAuth("../auth/login-form.php");
include '../layout/adminnavbar.php';
include "../../models/user.php";
include "../../models/product.php";
include "../../controller/order/allUsersOrders.php";

if (isset($_GET['from-date']) && isset($_GET['to-date']) && isset($_GET['name']) && $_GET['from-date'] != '' && $_GET['to-date'] != '' && $_GET['name'] != '') {
    $from_date = $_GET['from-date'];
    $to_date = $_GET['to-date'];
    $name = $_GET['name'];
    $users = allUsersOrdersFilter($from_date, $to_date, $name);
} else {
    $users = allUsersOrders();
}


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
                <form class="" method="get">

                    <input type="date" name="from-date" class=" border rounded" style="width: 20%;height:40px">

                    <input type="date" name="to-date" class="border rounded ml-3" style="width: 20%;height:40px">

                    <select id="exampleFormControlSelect1" name="name" class=" border rounded ml-3 " style="width: 20%;height:40px">
                        <option></option>
                        <?php
                        $userObject = new User();
                        $allUsers = $userObject->selectUsers(); ?>
                        <?php
                        foreach ($allUsers as $User) { ?>
                            <option value="<?php echo $User->username ?>" style="background-color:gray"><?php echo  $User->username ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="border rounded ml-3 text-light" style="width: 15%;height:40px ;background-color:#c49b63">Search</button>
                </form>
                <div>
                    <table class="table mt-5 p-1 table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>Name</th>
                                <th>Number of orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) { ?>
                                <tr class='text-left'>
                                    <td>
                                        <i class='fas fa-plus' data-toggle='nested-table' data-target='#nested-table-<?php echo $user["user_id"]; ?>'></i>
                                        <?php echo $user["user_name"]; ?>
                                    </td>
                                    <td><?php echo count($user["orders"]); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php foreach ($users as $user) { ?>
                        <table id="nested-table-<?php echo $user["user_id"]; ?>" class="table nested-table mt-5 p-1 table-bordered">
                            <thead class="thead-primary">
                                <tr>
                                    <th>Order Date</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user["orders"] as $order_id => $order_items) { ?>
                                    <tr class='text-left'>
                                        <td>
                                            <i class='fas fa-plus' data-toggle='nested-table' data-target='#nested-div-<?php echo $user["user_id"] . "-" . $order_id; ?>'></i>
                                            <?php echo $order_items[1]["order_date"]; ?>
                                        </td>
                                        <td>
                                            <?php echo array_reduce($order_items, function ($total, $item) {
                                                return $total + ($item["order_items"]["item_price"] * $item["order_items"]["item_quantity"]);
                                            }, 0) . '$'; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php foreach ($user["orders"] as $order_id => $order_items) { ?>
                            <div id="nested-div-<?php echo $user["user_id"] . "-" . $order_id; ?>" class="nested-table  mt-5 p-1 ">
                                <div class="container border">
                                    <p class="h4 text-center mt-5 mb-2">Order Items</p>

                                    <div class="row mt-5">
                                        <?php foreach ($order_items as $order_item) { ?>
                                            <?php
                                            $productOject = new Product();
                                            $product = $productOject->select_product($order_item["order_items"]["product_id"]) ?>

                                            <div class="col-3 mt-3  text-center">
                                                <div class="position-relative w-100 h-50 ml-3 mr-3">
                                                    <img src="<?php echo $product['image']; ?>" class="rounded-circle w-75 h-100" alt="item image" />
                                                    <span class="badge badge-secondary position-absolute top-0 start-50 translate-middle "><?php echo $order_item["order_items"]["item_quantity"]; ?></span>
                                                </div>

                                                <p><?php echo $product['name']; ?></p>
                                                <p>Price:<?php echo  $order_item["order_items"]["item_price"] . '$' ?></p>
                                                <p>Total price:<?php echo  $order_item["order_items"]["item_price"] * $order_item["order_items"]["item_quantity"] . '$'; ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>



            </div>
        </div>
    </div>
</section>



<?php
include '../layout/footer.php';
?>