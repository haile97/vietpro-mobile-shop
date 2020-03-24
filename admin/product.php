<?php


if (!defined('SECURITY')) {
    die('Bạn không có quyền truy cập vào file này!');
}
// phân trang

if (isset($_GET['page'])) {

    $page = $_GET['page'];
} else {
    $page = 1;
}
// Gán số trang cần hiển thị
$rows_per_page = 5;

//  tinh key $per_row
$per_row = $page * $rows_per_page - $rows_per_page;
//  truy van

$total_rows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product"));
$total_page = ceil($total_rows / $rows_per_page); //ham lam tron so

// nut preview
$list_page = '';
$prev_page = $page - 1;
if ($prev_page <= 0) {
    $prev_page = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $prev_page . '">&laquo;</a></li>'; //echo trong html '..'

// tinh toan so trang
for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        $active = 'active';
    } else {
        $active = '';
    }
    $list_page .= '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>'; //loi 1 html trong php dung .=
}
// nut next

$page_next = $page + 1;
if ($page_next > $total_page) {
    $page_next = $total_page;
}
$list_page .= ' <li class="page-item"><a class="page-link" href="index.php?page_layout=product&page' . $page_next . '">&raquo;</a></li>';


?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_product" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">

                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Tên sản phẩm</th>
                                <th data-field="price" data-sortable="true">Giá</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Danh mục</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM product INNER JOIN category ON product.cat_id=category.cat_id ORDER BY prd_id DESC LIMIT $per_row, $rows_per_page";
                            $query = mysqli_query($connect, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {


                            ?>
                                <tr>
                                    <td style=""><?php echo $row['prd_id']; ?></td>
                                    <td style=""><?php echo $row['prd_name']; ?></td>
                                    <td style=""><?php echo $row['prd_price']; ?></td>
                                    <td style="text-align: center"><img width="130" height="180" src="img/products/<?php echo $row['prd_image']; ?>" /></td>
                                    <td><span class="label <?php if ($row['prd_status'] == 1) {
                                                                echo 'label-success';
                                                            } else {
                                                                echo 'label-danger';
                                                            } ?>"><?php if ($row['prd_status'] == 1) {
                                                                        echo 'còn hàng';
                                                                    } else {
                                                                        echo 'hết hàng';
                                                                    } ?></span></td>
                                    <td><?php echo $row['cat_name']; ?></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_product&prd_id=<?php echo $row['prd_id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a onclick="return delItem('<?php echo $row['prd_name']; ?>')" href="del_product.php?prd_id=<?php echo $row['prd_id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php echo $list_page; ?>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>
<!--/.main-->
<script>
    function delItem(name) {
        return confirm('Bạn muốn xóa sản phẩm: ' + name + '?');
    }
</script>