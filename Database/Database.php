<?php
// Load environment variables from .env file
$env_path = dirname(__DIR__) . '/.env';
if (file_exists($env_path)) {
    $lines = file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        putenv($line);
    }
  
}

class Database{
    protected $db;
    protected $dbname='php_nabila';
    private function connect(){
        $dsn = "mysql:host=" . getenv('HOST') . ";port=" . getenv('PORT') . ";dbname=" . getenv('DB_NAME');
        $this->db= new PDO($dsn,  getenv('USERNAME'), getenv('PASSWORD'));
    }

    public function __construct(){
        $this->connect();
    }
    public function insert( string $table, ...$args){
        // save data 
        try {
            // prepare query fill it with column names
            $insert_query =  "insert into ".$this->dbname.".".$table." (";
            for($i = 0; $i < sizeof($args) / 2; $i++)
            {
                $insert_query.=$args[$i]; 
                if($i !== (sizeof($args)/2 - 1)) $insert_query.=",";
            }
            $insert_query.=") values (";
            for($i = 0; $i < sizeof($args) / 2; $i++)
            {
                $insert_query.="?"; 
                if($i !== sizeof($args)/2 - 1) $insert_query.=",";
            }
            $insert_query.=")";
            
            $inst_stmt = $this->db->prepare($insert_query);
            // execute query fill it with column names 
            $values = [];
            for($i = sizeof($args) / 2; $i < sizeof($args); $i++)
            {
                array_push($values, $args[$i]);
            }
            $res=$inst_stmt->execute($values);

        } catch (Exception $e) {
            var_dump( $inst_stmt->errorInfo());
            var_dump($e);
        }
    }
    public function select( string $table){
       
        $query = "select * from ".$this->dbname.".".$table;

        $stmt = $this->db->prepare($query);
    
        $res = $stmt->execute();
       
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        // free result set
        $stmt->closeCursor();
        return $data;
    }
    public function select_item( string $table, int $id){
        $query = "select * from ".$this->dbname.".".$table." where id=:user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $res = $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function update( string $table, int $id, ...$args){
        $query= "update ".$this->dbname.".".$table." set ";
        for($i = 0; $i < sizeof($args) / 2; $i++)
        {
            $query.=$args[$i]."=?"; 
            if($i !== (sizeof($args)/2 - 1)) $query.=",";
        }
        $query.=" where id=".$id;
        $stmt = $this->db->prepare($query);
        // execute query fill it with column names 
        $values = [];
        for($i = sizeof($args) / 2; $i < sizeof($args); $i++)
        {
            array_push($values, $args[$i]);
        }
        $res=$stmt->execute($values);
        
    }
    public function delete( string $table, int $id){
        $query="Delete from ".$this->dbname.".".$table." where id=:user_id";
        $delete_stmt = $this->db->prepare($query);
        $delete_stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $res=$delete_stmt->execute();
    }

    public function execute_query_without_id($query){
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    public function execute_query($query, $id){
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $data;
    }
}