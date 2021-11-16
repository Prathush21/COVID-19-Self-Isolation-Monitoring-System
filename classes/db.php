<?php

class Db{

    private static $_instance = null;

    private $pdo;
    private $query;

    private $dbHost;  
    private $dbName;  
    private $dbUser;      //by default root is user name.  
    private $dbPassword;  

    private function __construct() {
        $this->_dbHost='localhost';  
        $this->_dbName='symptom_tracker';  
        $this->_dbUser='root';      //by default root is user name.  
        $this->_dbPassword='';
        try {
            $this->_pdo = new PDO("mysql:host=$this->_dbHost;dbname=$this->_dbName",$this->_dbUser,$this->_dbPassword);  
            // Echo "Successfully connected with myDB database";  
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new Db();
        }
        return self::$_instance;
    }


    public function insert($table, $fields = array()){
        if(count($fields)) {
            $keys = array_keys($fields);
            $values = null;
            $x = 1;

            foreach ($fields as $field) {
                $values .= "?";
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO $table (`".implode('`, `', $keys)."`) VALUES ({$values})";

            // echo $sql;
            // if(!$this->query($sql, $fields)->error()) {
            //     return true;
            // }
            $this->_query = $this->_pdo->prepare($sql);
            $x = 1;
            if(count($fields)) {
                foreach($fields as $field) {
                    // echo $param;
                    $this->_query->bindValue($x, $field);
                    $x++;
                    // echo $x."<br>";
                }
            }
            $this->_query->execute();
            return true;

        }
        return false;
    }


    public function select($table,$uname){
        $stmt = $this->_pdo->prepare("SELECT * FROM $table WHERE username=?");
        $stmt->execute([$uname]); 
        $result = $stmt->fetch();

        if($result){
            return true;
        }
        return false;
    }

    public function get($table,$uname){

        $stmt = $this->_pdo->prepare("SELECT * FROM $table WHERE username=?");
        $stmt->execute([$uname]); 
        $result = $stmt->fetch();

        return $result;

    } 

    public function update($table, $uname, $fields) {
        if(count($fields)){
            $set = '';
            $x = 1;

            foreach($fields as $name => $value) {
                $set .= "{$name} = ?";
                if($x < count($fields)) {
                    $set .= ', ';
                }
                $x++;
            }
            // die($set);

            $sql = "UPDATE {$table} SET {$set} WHERE username = '{$uname}'";
            // echo $sql;

            $this->_query = $this->_pdo->prepare($sql);
            $x = 1;
            if(count($fields)) {
                foreach($fields as $field) {
                        // echo $param;
                    $this->_query->bindValue($x, $field);
                    $x++;
                        // echo $x."<br>";
                }
            }
            $this->_query->execute();
            return true;
        }
        return false;
        

        
    }



}

?>