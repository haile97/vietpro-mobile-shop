<?php
if(isset($_POST['keyword'])){
	$keyword = $_POST['keyword'];
}
else{
	$keyword = $_GET['keyword'];
}
$arr_keyword = explode(" ", $keyword);
$keyword_end = "%" . implode("%", $arr_keyword) . "%";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$row_per_page = 6;
$row_per = $page * $row_per_page - $row_per_page;

$sql = "SELECT * FROM product WHERE prd_name LIKE '$keyword_end' LIMIT $row_per, $row_per_page ";
$query = mysqli_query($connect, $sql);
$total = mysqli_num_rows($query);
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product WHERE prd_name LIKE '$keyword_end'"));
$total_page = ceil($total_row/$row_per_page);
$list_pages = '';

// nut pre
$page_prev = $page - 1;
if($page == 1){
	$disabled_prev = ' disabled';
}
else{
	$disabled_prev = '';
}

$list_pages .= '<li class="page-item'.$disabled_prev.'"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword_end.'&page='.$page_prev.'">Trang trước</a></li>';
for($i = 1; $i<=$total_page; $i++){
	
	if($i == $page){
		$active = ' active';
	}
	else{
		$active = '';
	}
	
	$list_pages .= '<li class="page-item'.$active.'"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword_end.'&page='.$i.'">'.$i.'</a></li>';
}
$page_next = $page + 1;

if($page == $total_page){
	$disabled_next = ' disabled';
}
else{
	$disabled_next = '';
}

$list_pages .= '<li class="page-item'.$disabled_next.'"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword_end.'&page='.$page_next.'">Trang sau</a></li>';



?>


<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <?php
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 1) {
            echo '<div class="product-list card-deck">';
        }
    ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
            <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
            <p>Giá Bán: <span><?php echo $row['prd_price']; ?>đ</span></p>
        </div>
    <?php
        if ($i == 3) {
            $i = 1;
            echo '</div>';
        } else {
            $i++;
        }
    }
    if ($total % 3 != 0) {
        echo '</div>';
    }
    ?>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <?php echo $list_pages;  ?>
    </ul>
</div>