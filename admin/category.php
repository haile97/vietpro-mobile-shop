<?php 
if(!defined('SECURITY')){
die('Bạn không có quyền truy cập vào file này!');
}

// phan trang

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}

// gan so trang can hien thi

$row_per_page = 3 ;

$row_per=$page*$row_per_page-$row_per_page;

// truy van
$sql = "SELECT * FROM category";
$query = mysqli_query($connect, $sql);
$total_row = mysqli_num_rows($query);
$total_page = ceil($total_row/$row_per_page);

// nut fre
$list_page = '';

$page_pre = $page - 1;
if($page_pre <= 0 ){
  $page_pre = 1 ;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$page_pre.'">&laquo;</a></li>';

//tinh so trang

for($i=1; $i<=$total_page; $i++){
	if($i==$page){
        $active = 'active';
    }else{
        $active = '';
    }

$list_page .='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
}
// nut next

$next_page = $page + 1;
if($next_page>=$total_page){
	$next_page = $total_page;
}
$list_page .='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$next_page.'">&raquo;</a></li>';


?>


		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Quản lý danh mục</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý danh mục</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_category" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm danh mục
            </a>
        </div>
		<div class="row">
			<div class="col-md-12">
					<div class="panel panel-default">
							<div class="panel-body">
								<table 
									data-toolbar="#toolbar"
									data-toggle="table">
		
									<thead>
									<tr>
										<th data-field="id" data-sortable="true">ID</th>
										<th>Tên danh mục</th>
										<th>Hành động</th>
									</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM category  ORDER BY cat_id ASC LIMIT $row_per, $row_per_page ";
										$query = mysqli_query($connect, $sql);
										while($row = mysqli_fetch_assoc($query)){
										?>
										<tr>
											<td style=""><?php echo $row['cat_id']; ?></td>
											<td style=""><?php echo $row['cat_name']?></td>
											<td class="form-group">
												<a href="index.php?page_layout=edit_category&cat_id=<?php echo $row['cat_id']  ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
												<a onclick="return delItem('<?php echo $row['cat_name'] ?>')" href="del_category.php?cat_id=<?php echo  $row['cat_id'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
											</td>
										</tr>

										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="panel-footer">
								<nav aria-label="Page navigation example">
									<ul class="pagination">
										<?php  echo $list_page ; ?>
									</ul>
								</nav>
							</div>
						</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	<script>
function delItem(name){
    return confirm('Bạn muốn xóa sản phẩm: '+name+'?');
}
</script>

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-table.js"></script>	

