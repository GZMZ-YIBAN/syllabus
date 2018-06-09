<?php
error_reporting(0);
include('config.php');
header("Content-type: text/html; charset=utf-8"); 
$mysqli = new mysqli($mysql_host,$mysql_user,$mysql_pwd,$mysql_db);
if($mysqli->connect_errno){
    die('Connect Error:'.$mysqli->connect_error);
}
$mysqli->set_charset("utf8");
if($_POST['college'] == true){
	$query = $mysqli->query("select * from major where id like '{$_POST['college']}%'");
	$list = $query->fetch_all(MYSQLI_ASSOC);
	echo json_encode($list);
}
?>
