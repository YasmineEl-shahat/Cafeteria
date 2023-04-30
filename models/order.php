<?php

require_once __DIR__ . '/../Database/Database.php';
class Order extends Database {
    public function __construct() {
        parent::__construct();
    }
    public function allUsersOrders(...$args) {
        $query = "SELECT *,count(*) as count FROM  ".$this->dbname.".Order o LEFT JOIN User u ON o.user_id = u.id LEFT JOIN Order_Item oi ON o.id = oi.order_id group by u.id";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
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
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $data;
    }


}


