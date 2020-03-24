<?php  
!defined('SECURiTY', true);
include_once('../config/connect.php');
session_start();
$cat_id = $_GET['cat_id'];
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    $sql = "DELETE FROM category WHERE cat_id = $cat_id";
    $query = mysqli_query($connect, $sql);
    header('location:index.php?page_layout=category');
}else{
    header('location:indec.php');
}



?>
