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
        //  -- WHERE `Order`.status = 'proccessig'
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    public function userOrders(...$args) {

        if(!isset($_SESSION)) {
            session_start();
        }
        $id= $_SESSION["user_id"];
        $query = "SELECT o.id, o.date_created , o.status, oi.price , oi.quantity
          FROM ".$this->dbname.".Order o
          LEFT JOIN Order_Item oi ON o.id = oi.order_id
          WHERE o.user_id = ?
          GROUP BY o.id";
//        $query = "SELECT o.date_created , o.status   FROM ".$this->dbname.".User u LEFT JOIN  Order o ON  o.user_id = u.id WHERE u.id =?";
//        $query = "SELECT o.id, o.date_created, o.status FROM User u LEFT JOIN `Order` o ON o.user_id = u.id WHERE u.id = ?";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $data;
    }
    public function userOrderItem($orderId) {

        if(!isset($_SESSION)) {
            session_start();
        }
        $id= $_SESSION["user_id"];
        $query = "SELECT o.id, oi.price , oi.quantity   FROM ".$this->dbname.".Order o LEFT JOIN Order_Item oi ON o.id = oi.order_id WHERE o.user_id =? and oi.order_id = $orderId ";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $data;
    }
    public  function userOrdersSearch($fromDate,$toDate){

        $id= $_SESSION["user_id"];
        $query = "SELECT * FROM ".$this->dbname.".Order o LEFT JOIN Order_Item oi ON o.id = oi.order_id WHERE o.user_id = ? AND STR_TO_DATE(o.date_created, '%Y-%m-%d') BETWEEN STR_TO_DATE($fromDate, '%Y-%m-%d') AND STR_TO_DATE($toDate, '%Y-%m-%d')";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute([$id]);
          $stmt = $this->db->prepare($query);
        $res = $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    public function get_order_items(string $id)
    {
        $query = "SELECT Product.name, Product.image, Order_Item.quantity
        FROM Product
        INNER JOIN Order_Item ON Product.id = Order_Item.product_id
        INNER JOIN `Order` ON Order_Item.order_id = `Order`.id
        WHERE `Order`.id = ?;
        
        ";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}