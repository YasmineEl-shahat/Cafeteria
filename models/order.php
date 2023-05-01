<?php

require_once __DIR__ . '/../Database/Database.php';
class Order extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertorder(...$args)
    {
        parent::insert("Order", ...$args);
    }

    public function selectorders()
    {
        return parent::select("Order");
    }

    public function select_order(int $id)
    {
        return parent::select_item("Order", $id);
    }

    public function update_order(int $id, ...$args)
    {
        parent::update("Order", $id, ...$args);
    }

    public function delete_order(int $id)
    {
        parent::delete("Order", $id);
    }

    public function get_users_orders()
    {
        $query = "SELECT Order.id as id, Order.status as status, User.username as client, User.room as room, Order.date_created 
        FROM User
        INNER JOIN `Order` ON User.id = `Order`.user_id;
        WHERE `Order`.status = 'outForDelivery'";
        //  -- WHERE `Order`.status = 'processing'
        return Parent::execute_query_without_id($query);
    }
    public function userOrders(...$args) {

        if(!isset($_SESSION)) {
            session_start();
        }
        $id= $_SESSION["user_id"];
        $query = "SELECT  o.id as `order_id`, 
    o.date_created as `order_date`, 
    o.status as `order_status`,
    oi.id as `order_item_id`, 
    oi.product_id as `product_id`, 
    oi.price as `item_price`, 
    oi.quantity as `item_quantity`
          FROM ".$this->dbname.".Order o
          LEFT JOIN Order_Item oi ON o.id = oi.order_id
          WHERE o.user_id = ?
         ";
        $data=Parent::execute_query($query, $id);
        return $this->result($data);
    }

public function result($data){
        // Create an array to store the user and order data
        $orders = array();

// Loop through the result set and populate the users array
        foreach ($data as $row) {
            // Create a user object if it doesn't exist
            if (!isset($orders[$row->order_id])) {
                $orders[$row->order_id] = array(
                    'order_id' => $row->order_id,
                    'order_status' => $row->order_status,
                    'order_date' => $row->order_date,
                    'order_items' => array()
                );
            }

            // Add the order data to the user's orders array
            $orders[$row->order_id]['order_items'][] = array(
                'order_item_id' => $row->order_item_id,
                'product_id' => $row->product_id,
                'item_price' => $row->item_price,
                'item_quantity' => $row->item_quantity,
            );
        }
        return $orders;
    }

    public function userOrdersSearchByDate($fromDate,$toDate){
        $id= $_SESSION["user_id"];
        $query = "SELECT  o.id as `order_id`, 
    o.date_created as `order_date`, 
    o.status as `order_status`,
    oi.id as `order_item_id`, 
    oi.product_id as `product_id`, 
    oi.price as `item_price`, 
    oi.quantity as `item_quantity`
          FROM ".$this->dbname.".Order o
          LEFT JOIN Order_Item oi ON o.id = oi.order_id
          WHERE o.user_id = ?
          AND  (DATE_FORMAT(o.date_created, '%Y-%m-%d') BETWEEN DATE_FORMAT('$fromDate', '%Y-%m-%d') AND DATE_FORMAT('$toDate', '%Y-%m-%d')) ";$data=Parent::execute_query($query, $id);
        return $this->result($data);
    }

    public function get_order_items(string $id)
    {
        $query = "SELECT Product.name, Product.image, Order_Item.quantity
        FROM Product
        INNER JOIN Order_Item ON Product.id = Order_Item.product_id
        INNER JOIN `Order` ON Order_Item.order_id = `Order`.id
        WHERE `Order`.id = ?;
        ";
        return Parent::execute_query($query, $id);
    }
    public function select_last_order_id(){
        $query = 'SELECT `id` FROM `Order` ORDER BY `id` DESC LIMIT 1';
        return Parent::execute_query_without_id($query);
    }
    public function insert_order_item(...$args){
        parent::insert("Order_Item", ...$args);
    }
}