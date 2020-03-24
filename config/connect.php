<?php 

$connect = mysqli_connect('localhost', 'root', '', 'phpk180');

if($connect){
    mysqli_query($connect, "SET NAMES 'utf8'");
}else{
    echo 'Kết nối thất bại!';
}


?>