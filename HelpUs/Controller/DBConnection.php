<?php
class Connection {
    
    public $host = "localhost";
    public $dbname = "help_us";
    public $user = "root";
    public $pass = "";
    public $Conn;

    function __construct(){
        try {
            $this->Conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            //echo "Connection successful!";
        }
        catch (PDOException $e){
            echo "Error occured: " . $e->getMessage();
        }
    }
    public function closeConnection(){
        $this->Conn = null;
    }
}
?>