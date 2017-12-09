<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <form method="POST" action="./<?=basename(__FILE__)?>">
       <div>DB name:<input name="DB name"></input>DB query:<input style="width:50%;" name="SQL query"></input><input type="submit"></input></div>
   </form>
   <?php
   class SQLConnection{
    private $conn;
    public function getConnection(){
        return $this->conn;
    }
    public function __construct(){
        $this->reConnect();
    }
    function reConnect(){
        $this->close();
        $this->conn = @mysqli_connect('localhost:8889','root','root');
        if (mysqli_connect_errno()){
            die("conn error".mysqli_error($this->conn));
        }
    }
    function close(){
        if($this->isConnected()){
            mysqli_close($this->conn);
            $this->conn=null;
        }
    }
    function isConnected(){
        return ($this->conn!=null);
    }
    private function checkSystemDB($val){
        $rst = false;
        $lst = array('information_schema','mysql','performance_schema');
        foreach($lst as $item){
            $rst = $rst || $val==$item;
        }
        return $rst;
    }
    public function checkMemberOfDBLists($v){
        if($this->isConnected()){
            $query = "show databases;";
            $db_list = mysqli_query($this->conn,$query);
            while ($row = mysqli_fetch_row($db_list)) {
                if((!$this->checkSystemDB($row[0]))&&$row[0]==$v){
                    return true;
                }
            }
            return false;
        }
        else{
            return false;
        }

    }
    public function getDBList(){
        $rst = array();
        if($this->isConnected()){
            $query = "show databases;";
            $db_list = mysqli_query($this->conn,$query);
            while ($row = mysqli_fetch_row($db_list)) {
                if(!$this->checkSystemDB($row[0]))
                array_push($rst,$row[0]);
            }
        }
        else{
            array_push($rst,"connerror");
        }
        return $rst;
    }
}
class SQLConnection2{
    private $conn;
    public function getConnection(){
        return $this->conn;
    }
    public function __construct(){
        $this->reConnect();
    }
    function reConnect(){
        $this->close();
        $this->conn = new mysqli("localhost:8889",'root','root'); 
        if ($this->conn->connect_errno){
            die("conn error".$this->conn->connect_error);
        }
    }
    function close(){
        if($this->isConnected()){
            $this->conn->close();
            $this->conn=null;
        }
    }
    function isConnected(){
        return ($this->conn!=null)&&!$this->conn->connect_errno;
    }
    private function checkSystemDB($val){
        $rst = false;
        $lst = array('information_schema','mysql','performance_schema');
        foreach($lst as $item){
            $rst = $rst || $val==$item;
        }
        return $rst;
    }
    
}
function checkNULL($var){
    return $var==''||$var==null;
}

$dnkey = "DB_name";
$qrykey = "SQL_query";
   if(isset($_POST[$dnkey])&&isset($_POST[$qrykey])&&!checkNULL($_POST[$dnkey])&&!checkNULL($_POST[$qrykey])){
   $conn = new SQLConnection2();
   $dbn = $_POST[$dnkey];
   $rawquery = $_POST[$qrykey];
   $conn->getConnection()->select_db($dbn);
   $res = $conn->getConnection()->query($rawquery);

   ?>
   
   <ul>
       <?php while($row = $res->fetch_row()){
           
           ?>
        <li><?= implode(" ",$row) ?></li>
       <?php } ?>
   </ul>
<?php
$conn->close();
} ?>
</body>
</html>