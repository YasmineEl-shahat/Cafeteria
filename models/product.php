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
    
    public function select_product(int $id) {
        return parent::select_item("Product", $id);
    }
    
    public function update_product(int $id, ...$args) {
        parent::update("Product", $id, ...$args);
    }
    
    public function delete_product(int $id) {
        parent::delete("Product", $id);
    }

}


