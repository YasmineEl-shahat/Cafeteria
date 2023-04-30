<?php
include '../layout/navbar.php';
include "../../models/user.php";
$dsn = 'mysql:dbname=php_nabila;host=nader-mo.tech;port=3306;';
$db = new PDO($dsn, 'php_nabila', 'Aa123456');
if (isset($_GET['from-date']) && isset($_GET['to-date']) && isset($_GET['name']) && $_GET['from-date'] != '' && $_GET['to-date'] != '' && $_GET['name'] != '') {
    $from_date = $_GET['from-date'];
    $to_date = $_GET['to-date'];
    $name = $_GET['name'];
    $query = "SELECT u.id as `user_id`, 
    u.username as `user_name`, 
    o.id as `order_id`, 
    o.date_created as `order_date`, 
    oi.id as `order_item_id`, 
    oi.product_id as `product_id`, 
    oi.price as `item_price`, 
    oi.quantity as `item_quantity`
FROM php_nabila.Order o 
LEFT JOIN User u ON o.user_id = u.id 
LEFT JOIN Order_Item oi ON o.id = oi.order_id
WHERE (DATE_FORMAT(o.date_created, '%Y-%m-%d') BETWEEN DATE_FORMAT('$from_date', '%Y-%m-%d') AND DATE_FORMAT('$to_date', '%Y-%m-%d')) 
AND (u.username LIKE '%$name%')";
} else {
    $query = "
    SELECT 
        u.id as `user_id`, 
        u.username as `user_name`, 
        o.id as `order_id`, 
        o.date_created as `order_date`, 
        oi.id as `order_item_id`, 
        oi.product_id as `product_id`, 
        oi.price as `item_price`, 
        oi.quantity as `item_quantity` 
    FROM php_nabila.Order o 
    LEFT JOIN User u ON o.user_id = u.id 
    LEFT JOIN Order_Item oi ON o.id = oi.order_id";
}
$stmt = $db->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_OBJ);
$stmt->closeCursor();
//var_dump($data) ;

// Create an array to store the user and order data
$users = array();

// Loop through the result set and populate the users array
foreach ($data as $row) {
    // Create a user object if it doesn't exist
    if (!isset($users[$row->user_id])) {
        $users[$row->user_id] = array(
            'user_id' => $row->user_id,
            'user_name' => $row->user_name,
            'orders' => array()
        );
    }

    // Add the order data to the user's orders array
    $users[$row->user_id]['orders'][$row->order_id][] = array(
        'order_id' => $row->order_id,
        'order_date' => $row->order_date,
        'order_items' => array(
            'order_item_id' => $row->order_item_id,
            'product_id' => $row->product_id,
            'item_price' => $row->item_price,
            'item_quantity' => $row->item_quantity
        )
    );
}
//var_dump($users)

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
                                            }, 0); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php foreach ($user["orders"] as $order_id => $order_items) { ?>
                            <div id="nested-div-<?php echo $user["user_id"] . "-" . $order_id; ?>" class="nested-table  mt-5 p-1 border">
                                <div class="row">
                                    <?php foreach ($order_items as $order_item) { ?>
                                        <div class="col-3">
                                            <img class="w-100 h-50" src="../../assets/images/about.jpg" />
                                            <p>id:<?php echo $order_item["order_items"]["product_id"]; ?></p>
                                            <p>quantity:<?php echo $order_item["order_items"]["item_quantity"]; ?></p>
                                            <p>price:<?php echo  $order_item["order_items"]["item_price"] ?></p>
                                            <p>total price:<?php echo  $order_item["order_items"]["item_price"] * $order_item["order_items"]["item_quantity"]; ?></p>
                                        </div>
                                    <?php } ?>
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