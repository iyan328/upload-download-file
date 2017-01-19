<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbnm = "tes_ta";
$conn = mysql_connect($host,$user,$pass);
if($conn){
	$buka = mysql_select_db($dbnm);
if(!$buka){
	die ("Database tidak dapat dibuka");
}
else{
	echo("");
}
}
?>