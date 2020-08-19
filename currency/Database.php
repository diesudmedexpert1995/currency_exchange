<?php
  /**
   *
   */
  class Database
  {
    private $host;
    private $dbname;
    private $login;
    private $password;
    private $connection;

    public function __construct($host="3306", $dbname="currency_exchange", $login="admin",$password="Q1w2e3r4t5y6u7i8o9p0_1995")
    {
      $this->host = $host;
      $this->dbname = $dbname;
      $this->login=$login;
      $this->password=$password;
      try {
        $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->login,$this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo "Error: ".$e->getMessage();
      }

    }

    public function getHost(){
      return $this->host;
    }

    public function setHost($host){
      $this->host = $host;
      return $this;
    }

    public function getDbname(){
      return $this->dbname;
    }

    public function setDbname($dbname){
      $this->dbname = $dbname;
      return $this;
    }

    public function getLogin(){
      return $this->login;
    }

    public function setLogin($login){
      $this->dbname = $login;
      return $this;
    }

    public function getPassword(){
      return $this->password;
    }

    public function setPassword($password){
      $this->password = $password;
      return $this;
    }

    public function createTransactionTable(){
      try {
        $queryStr = "CREATE TABLE transactions (id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, card_from VARCHAR(12), card_to VARCHAR(12), amonut REAL VARCHAR(150), status VARCHAR(128))";
        $db->query($queryStr);
      } catch (\Exception $e) {
          $e->getMessage();
      }
    }

    public function selectFromTransactionTable(){
      $result = null;
      try {
        $queryStr = "SELECT * FROM transactions WHERE ?";
        $query = $db->prepare($queryStr);
        $query->execute();
        $result = $query.fetch();
        $query->closeCursor();
      } catch (\Exception $e) {
          $e->getMessage();
      }
      return $result;
    }

    public function insertInTransactionTable($values=[]){
      try {
        $queryStr = "INSERT INTO transactions (id, card_from, card_to, amount, status) VALUES ('$values[0]', $values[1], $values[2], $values[3], $values[4])";
        $db->query($queryStr);
      } catch (\Exception $e) {
          $e->getMessage();
      }
    }

  }

?>
