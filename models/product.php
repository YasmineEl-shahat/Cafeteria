<?php

require_once __DIR__ . '/../Database/Database.php';
class Product extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    public function insertProduct(...$args) {
        parent::insert("Product", ...$args);
    }
    
    public function selectProducts() {
        return parent::select("Product");
    }
    
    public function selectProductsCategory($category) {
        $products = parent::select("Product");
        $filtered = array_filter($products, function($product) use ($category) {
            return $product->category_id == $category;
        });
        return array_values($filtered);
    }
    public function select_product(int $id) {
        return parent::select_item("Product", $id);
    }
    
    public function update_product(int $id, ...$args) {
        parent::update("Product", $id, ...$args);
    }
    // public function updateAvailability(int $id, string $availability) {
    //     parent::update("Product", $id, $availability);
    // }
    public function delete_product(int $id) {
        parent::delete("Product", $id);
    }

}


