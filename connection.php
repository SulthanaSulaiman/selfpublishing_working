<?php
try{
$conn=new mysqli("localhost","root","","selfpublish");
if($conn->connect_error){
    die("Connection Failed!".$conn->connect_error);
}
}

catch(Exception $e) {
    echo 'Error: ' .$e->getMessage();
}


class DAO
{

    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "selfpublish";
    public $cnx = null;

    public function connection (){
  
        $this->cnx = new PDO("mysql:host=$this->servername;dbname=".$this->dbname, $this->username, $this->password);

    }
    public function GetAllUsers(){
        $this->connection();
        $p = $this->cnx->prepare('SELECT * FROM covers');
        $p->execute();

        $result = $p->fetchAll();

        return $result; 
    }

public function GetresultByPage($num){

$this->connection();
$p = $this->cnx->prepare('SELECT * FROM covers LIMIT '.(($num-1)*6).', 6');
$p->execute();
$result = $p->fetchAll();
return $result;

}

}

?>

