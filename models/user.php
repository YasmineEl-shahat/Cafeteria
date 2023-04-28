<?php

require_once __DIR__ . '/../Database/Database.php';
class User extends Database {
    public function __construct() {
        parent::__construct(); 
    }
    public function insertUser(...$args) {
        parent::insert("User", ...$args);
    }
    
    public function selectUsers() {
        return parent::select("User");
    }
    
    public function select_user(int $id) {
        return parent::select_item("User", $id);
    }
    
    public function update_user(int $id, ...$args) {
        parent::update("User", $id, ...$args);
    }
    
    public function delete_user(int $id) {
        parent::delete("User", $id);
    }

    public function select_item_email( string $email){
   
        var_dump($email);
        $query = "select * from ".$this->dbname.". User where email=:user_email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_email', $email, PDO::PARAM_STR);
        $res = $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}


