<?php 

$khoa_hoc = array(
    "mon 1" => "thiet ke",
    "mon 2" => "lap trinh",
    "mon 3" => "CSDL"
);

$arr = array(
    "khoahoc" => $khoa_hoc,
    "thoigian" => "3thang"
);

foreach($arr['khoahoc'] as $value ){
    echo $value."<br/>";
}



?>


<?php
session_start();
$prd_id = $_GET['prd_id'];

if(isset($_SESSION['cart'][$prd_id])){
	$_SESSION['cart'][$prd_id]++;
}
else{
	$_SESSION['cart'][$prd_id] = 1;
}
header('location:../../index.php?page_layout=cart');
?>