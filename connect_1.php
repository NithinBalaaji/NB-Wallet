<?php
$connect=mysqli_connect('localhost', 'root','','wallet');
$db=mysqli_select_db($connect , 'wallet');
if(!$connect)
	die("Database Connection failed" . mysqli_error($connect));
if(!$db){
	$sql="create database wallet";
	$dbcreate=mysqli_query($connect , $sql);
}
$q="create table if not exists users ( fullname varchar(255) , username varchar(255) NOT NULL , password varchar(255) , email varchar(255) , primary key(username) )";
$r=mysqli_query($connect , $q);

?>
