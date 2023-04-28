<?php

require_once __DIR__ . '/../Database/Database.php';
class Category extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    public function insertCategory(...$args) {
        parent::insert("Category", ...$args);
    }
    
    public function selectCategories() {
        return parent::select("Category");
    }
    
    public function select_Category(int $id) {
        return parent::select_item("Category", $id);
    }
    
    public function update_Category(int $id, ...$args) {
        parent::update("Category", $id, ...$args);
    }
    
    public function delete_Category(int $id) {
        parent::delete("Category", $id);
    }

}


