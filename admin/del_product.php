<?php
define('SECURITY', true);
include_once('../config/connect.php');
session_start();
$prd_id = $_GET['prd_id'];
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){

    $sql = "DELETE FROM product WHERE prd_id=$prd_id";
    $query = mysqli_query($connect, $sql);
    header("location:index.php?page_layout=product");

}else{header('location: index.php');}





?>