<?php

require_once __DIR__ . '/../Database/Database.php';
class Cart extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertCart(...$args)
    {
        parent::insert("Cart", ...$args);
    }

    public function selectCarts()
    {
        return parent::select("Cart");
    }

    public function select_Cart(int $id)
    {
        return parent::select_item("Cart", $id);
    }

    public function update_Cart(int $id, ...$args)
    {
        parent::update("Cart", $id, ...$args);
    }

    public function delete_Cart(int $id)
    {
        parent::delete("Cart", $id);
    }

    public function get_users_Carts()
    {
        $query = "SELECT Cart.id as id, User.username as client
        FROM User
        INNER JOIN `Cart` ON User.id = `Cart`.`user_id`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    public function get_Cart_items(string $id)
    {
        $query = "SELECT Product.name, Product.image, Cart_Item.quantity
        FROM Product
        INNER JOIN Cart_Item ON Product.id = Cart_Item.product_id
        INNER JOIN `Cart` ON Cart_Item.cart_id = `Cart`.id";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}
