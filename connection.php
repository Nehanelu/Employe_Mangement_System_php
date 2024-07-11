<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'employee';
$conn = mysqli_connect($servername ,$username, $password, $dbname);
if ($conn){
 //   echo'connection suscessfull';
}
else{
    echo 'not connected';
}
?>