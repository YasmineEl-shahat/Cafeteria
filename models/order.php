<?php

require_once __DIR__ . '/../Database/Database.php';
class Order extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    public function insertorder(...$args) {
        parent::insert("Order", ...$args);
    }
    
    public function selectorders() {
        return parent::select("Order");
    }
    
    public function select_order(int $id) {
        return parent::select_item("Order", $id);
    }
    
    public function update_order(int $id, ...$args) {
        parent::update("Order", $id, ...$args);
    }
    
    public function delete_order(int $id) {
        parent::delete("Order", $id);
    }

    public function get_users_orders(){
        $query = "SELECT Order.id, Order.status, User.username as client, User.room
        FROM User
        INNER JOIN `Order` ON User.id = `Order`.user_id
        WHERE `Order`.status = 'proccessig';
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    public function get_order_items(string $id){
        $query = "SELECT *
        FROM Order_Item
        WHERE order_id = :id;
        ";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute();
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}


// INSERT INTO Product (name, price, category_id, date_created,image) VALUES
//   ('Coffee', 1.99, 3, NOW(),'../../assets/images/products/menu-1.jpg'),
//   ('Tea', 1.49, 3, NOW(),'../../assets/images/products/menu-2.jpg'),
//   ('Iced Tea', 2.49, 4, NOW(),'../../assets/images/products/drink-8.jpg'),
//   ('Orange Juice', 3.99, 4, NOW(),'../../assets/images/products/drink-1.jpg'),
//   ('Bagel with Cream Cheese', 2.99, 5, NOW(),'../../assets/images/products/drink-9.jpg'),
//   ('Egg Sandwich', 3.99, 5, NOW(),'../../assets/images/products/dish-1.jpg'),
//   ('BLT Sandwich', 5.99, 6, NOW(),'../../assets/images/products/dish-2.jpg'),
//   ('Grilled Cheese Sandwich', 4.99, 6, NOW(),'../../assets/images/products/dish-3.jpg'),
//   ('Garden Salad', 6.99, 7, NOW(),'../../assets/images/products/dish-4.jpg'),
//   ('Greek Salad', 7.99, 7, NOW(),'../../assets/images/products/dish-5.jpg'),
//   ('Chocolate Chip Cookie', 1.99, 8, NOW(),'../../assets/images/products/dish-6.jpg'),
//   ('Brownie', 2.49, 8, NOW(),'../../assets/images/products/dish-7.jpg');
