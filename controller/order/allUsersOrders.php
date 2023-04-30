<?php

function allUsersOrdersFilter($from_date, $to_date, $name)
{
    $dsn = 'mysql:dbname=php_nabila;host=nader-mo.tech;port=3306;';
    $db = new PDO($dsn, 'php_nabila', 'Aa123456');
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
    $stmt = $db->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt->closeCursor();
    return result($data);
}



function allUsersOrders()
{
    $dsn = 'mysql:dbname=php_nabila;host=nader-mo.tech;port=3306;';
    $db = new PDO($dsn, 'php_nabila', 'Aa123456');
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
    $stmt = $db->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt->closeCursor();
    return result($data);
}

function result($data){
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
return $users;
}
