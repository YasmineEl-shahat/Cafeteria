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
    public function selectCategoryIdByName(string $name) {
        $sql = "SELECT id FROM Category WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        var_dump($result);
        if (count($result) > 0) {
            return $result[0]->id;
        } else {
            return null;
        }
    }
    public function selectCategoryNameById($id) {
        $sql = "SELECT name FROM Category WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (count($result) > 0) {
            return $result[0]->name;
        } else {
            return null;
        }
    }

}


