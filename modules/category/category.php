<?php
$cat_id = $_GET['cat_id'];
$cat_name = $_GET['cat_name'];

//	Pagination
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
else{
	$page = 1;	
}
$rows_per_page = 6;
$per_row = $page*$rows_per_page - $rows_per_page;

$sql = "SELECT * FROM product
		WHERE cat_id = $cat_id
		ORDER BY prd_id DESC
		LIMIT $per_row, $rows_per_page";
$query = mysqli_query($connect, $sql);
$rows = mysqli_num_rows($query);


$total_rows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product WHERE cat_id = $cat_id"));
$total_pages = ceil($total_rows/$rows_per_page);

$list_pages = '';
// nut prew
$page_prev = $page - 1;
if($page_prev <= 0 ){
	$page_prev = 1;
}
$list_pages = '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$page_prev.'">Trang trước</a></li>';

// tinh toan so trang

for($i = 1; $i <= $total_pages; $i++){
	if($i == $page){
		$active = 'active';
	}else{
		$active = ''; 
	}
$list_pages = ' <li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$i.'">'.$i.'</a></li>';
}
// nut next
$next_page = $page + 1;
if($next_page > $total_pages){
	$next_page = $total_pages;
}
$list_pages = '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$next_page.'">Trang sau</a></li>';

?>
<!--	List Product	-->
<div class="products">
    <h3><?php echo $cat_name;?> (hiện có <?php echo $total_rows;?> sản phẩm)</h3>
        <?php
		$i=1;
        while($row = mysqli_fetch_array($query)){
			if($i==1){
				echo '<div class="product-list card-deck">';
			}
		?>
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><img src="admin/img/products/<?php echo $row['prd_image'];?>"></a>
                <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><?php echo $row['prd_name'];?></a></h4>
                <p>Giá Bán: <span><?php echo $row['prd_price'];?>đ</span></p>
            </div>
        <?php
			if($i==3){
				$i=1;
				echo '</div>';
			}
			else{
				$i++;
			}
		}
		if($rows%3!=0){
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