<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'efigen';

$conection = @mysqli_connect($host,$user,$password,$db);

if(!$conection){
  echo "NO SE CONECTO ESTA LOCUO";
}



 ?>
