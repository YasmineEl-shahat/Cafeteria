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

    public function update_Cart_Item(int $id, ...$args)
    {
        parent::update("Cart_Item", $id, ...$args);
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
    public function get_user_Cart_id(int $user_id){
        $query = 'select id from Cart where user_id=:user_id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
   
    public function get_Cart_items(string $id)
    {
        $query = "SELECT Cart_Item.id as id ,product_id, Product.name as name, Product.price as price, Product.image as image, Cart_Item.quantity as quantity
        FROM Product
        INNER JOIN Cart_Item ON Product.id = Cart_Item.product_id
        INNER JOIN `Cart` ON Cart_Item.cart_id = `Cart`.id where Cart.id=?";
        return Parent::execute_query($query, $id);
    }
    public function add_Cart_Item(int $cart_id, int $product_id){
        parent::insert("Cart_Item",
        "cart_id","product_id", "quantity",
         $cart_id, $product_id,  1);
    }
    public function remove_Cart_Item(int $cart_id, int $product_id){
        $query="Delete from Cart_Item where cart_id=:cart_id and product_id=:product_id";
        $delete_stmt = $this->db->prepare($query);
        $delete_stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $delete_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $res=$delete_stmt->execute();
    }
    public function getTotalPrice(string $id){
        $query = "select sum(quantity*price) as total from Cart_Item inner join Product 
        on product_id = Product.id where cart_id = ?";
        return Parent::execute_query($query, $id);
    }
    public function clear_cart(string $id){
        $query = "delete from Cart_Item where cart_id = ?";
        return Parent::execute_query($query, $id);
    }
    public function is_in_cart(int $cart_id, int $product_id){
        $query = "select product_id from Cart_Item where cart_id=:cart_id and product_id=:product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $res = $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function admin_add_Cart_Item(int $cart_id, int $product_id, int $quantity){
        parent::insert("Cart_Item",
        "cart_id","product_id", "quantity",
         $cart_id, $product_id,  $quantity);
    }
}
