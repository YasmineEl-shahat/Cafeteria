<?php

require_once __DIR__ . '/../Database/Database.php';
class Order extends Database {
    public function __construct() {
        parent::__construct();
    }
    public function allUsersOrders(...$args) {
        $query = "SELECT * FROM ".$this->dbname.".Order o LEFT JOIN User u ON o.user_id = u.id LEFT JOIN Order_Item oi ON o.id = oi.order_id";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $data;
    }
    public function userOrders(...$args) {
        $id= $_SESSION["user_id"];
        $query = "SELECT * FROM ".$this->dbname.".Order o LEFT JOIN Order_Item oi ON o.id = oi.order_id WHERE o.user_id = $id";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $data;
    }


}


