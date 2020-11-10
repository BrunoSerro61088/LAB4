<?php
// mostra uma mensagem de erro vinda do mysql
function showerror()
{
 die("Error " . mysqli_errno() . " : " .
mysqli_error());
}
$hostname = "10.10.23.183";
$db_name = "db_a61088";
$db_user = "a61088";
$db_passwd = "f2c4f9";
// faz uma conexão a uma base de dados
function dbconnect($hostname, $db_name,$db_user,$db_passwd)
{
 $db = @ mysqli_connect($hostname, $db_user, $db_passwd,
$db_name);
 if(!$db) {
 die("Connection failed: " . mysqli_connect_error());
 }
return $db;
}
?>