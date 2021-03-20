<?php
class DB_Connect {
    private $conn;
 
    public function connect() {
        require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/config.php';
         
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        
         
        return $this->conn;
    }
}
 
?>
