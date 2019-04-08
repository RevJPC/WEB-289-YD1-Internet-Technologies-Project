<?php
// database connection

class Database{
  
// credentials
  private $host = 'localhost';
  private $db_name = 'bvxwtrmy_bcm_0.2';
  private $username = 'bvxwtrmy_bcmUser';
  private $password = 'password';
  public $conn;

  public function getConnection(){

    $this->conn = null;
    try{
      $this->conn = new PDO('mysql:host=' . ';dbname=' . $this->db_name, $this->username, $this->password);
    }catch(PDOException $exception){
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
?>