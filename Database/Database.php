<?php
class Database{
    function connect(string $dbname,string $user,string $password){
        $dsn = 'mysql:dbname='.$dbname.';host=nader-mo.tech;port=3306;'; 
        $db= new PDO($dsn, $user, $password);
        return $db;
    }
    function insert($db,string $dbname, string $table, ...$args){
        // save data 
        try {
            // prepare query fill it with column names
            $insert_query =  "insert into ".$dbname.".".$table." (";
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
            
            $inst_stmt = $db->prepare($insert_query);
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
    function select($db, string $dbname, string $table){

        $query = "select * from ".$dbname.".".$table;

        $stmt = $db->prepare($query);
    
        $res = $stmt->execute();
       
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        // free result set
        $stmt->closeCursor();
        return $data;
    }
    function select_item($db, string $dbname, string $table, int $id){
        $query = "select * from ".$dbname.".".$table." where id=:user_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $res = $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function select_item_email($db, string $dbname, string $table, string $email){
        $query = "select * from ".$dbname.".".$table." where email=:user_email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_email', $email, PDO::PARAM_STR);
        $res = $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function update($db, string $dbname, string $table, int $id, ...$args){
        $query= "update ".$dbname.".".$table." set ";
       
        for($i = 0; $i < sizeof($args) / 2; $i++)
        {
            $query.=$args[$i]."=?"; 
            if($i !== (sizeof($args)/2 - 1)) $query.=",";
        }
        $query.=" where id=".$id;
        $stmt = $db->prepare($query);
        // execute query fill it with column names 
        $values = [];
        for($i = sizeof($args) / 2; $i < sizeof($args); $i++)
        {
            array_push($values, $args[$i]);
        }
        $res=$stmt->execute($values);
        
    }
    function delete($db, string $dbname, string $table, int $id){
        $query="Delete from ".$dbname.".".$table." where id=:user_id";
        $delete_stmt = $db->prepare($query);
        $delete_stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $res=$delete_stmt->execute();
    }
}