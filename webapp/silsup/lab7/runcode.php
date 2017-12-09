<html>
<head>
<title>test</title>
</head>
<body>
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
function checkNULL($var){
    return $var==''||$var==null;
}
$sqlconn = new SQLConnection();
if(isset($_POST["db_name"])&&!checkNULL($_POST["db_name"])&&isset($_POST["query"])&&!checkNULL($_POST["query"])){
    $raw_db_name = $_POST["db_name"];
    $raw_query = $_POST["query"];
    if(!preg_match("/^([A-za-z0-9\_]+)$/",$raw_db_name)||!$sqlconn->checkMemberOfDBLists($raw_db_name)){
        die("no hack >.O");
    }
    if(!preg_match("/(^(select|insert into |delete from |update |drop table |create |commit|rollback|use ))((.|\n)+)((;((\n)*))$)/i",$raw_query)){
        die("format error >.<");
    }
    mysqli_select_db($sqlconn->getConnection(),$raw_db_name);
    if($sqlconn->isConnected()){
        $qrys=explode("\n",$raw_query);
        foreach($qrys as $qries){
            if(checkNULL($qries)){continue;}
            if(preg_match("/^(use\ ([A-za-z0-9\_]+);)$/i",$qries)&&$sqlconn->checkMemberOfDBLists(explode(";",(explode(" ",$qries)[1]))[0])){
                mysqli_select_db($sqlconn->getConnection(),explode(";",(explode(" ",$qries)[1]))[0]);
            }
            
       $qry = mysqli_query($sqlconn->getConnection(),$qries);
       ?>
       <ul>
       <?php
       while ($row = mysqli_fetch_row($qry)) {
            ?>
            <li><?=implode(" , ",$row)?></li>
            <?php
       }
       ?>
       </ul>
       <?php 
        }
    }
    else{
        echo "parse error";
    }
    ?>
    <a href="./<?=basename(__FILE__)?>">돌아가기</a>
<?php }
else{ ?>
<form method="POST" action="./<?=basename(__FILE__)?>">
    <div>
        데이터 베이스: 
        <select name="db_name">
            <?php foreach($sqlconn->getDBList() as $lst){ ?>
            <option value="<?=$lst?>"><?=$lst?></option>
<?php } ?>
        </select>
        
    </div>
    <div>
        <textarea style="width:100%" name="query" rows="40" cols="5"></textarea>
    </div>
    <div>

    </div>
    <input type="submit" value="제출"></input>
</form>
<?php }
$sqlconn->close();
?>
</body>
</html>