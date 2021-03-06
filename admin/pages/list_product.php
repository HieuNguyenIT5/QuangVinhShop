<?php 
//Lấy danh sách các sản phẩm
$sql = "SELECT * FROM danhmuc, sanpham, hang where danhmuc.MaDM = sanpham.MaDM and sanpham.MaHang = hang.MaHang";
$result = mysqli_query($conn, $sql);
$list_sanpham = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_sanpham[] = $row;
    }
}
$num_img = count($list_sanpham);
$numOnPage = 10;
$numPage = ($num_img/$numOnPage)+1;
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(69)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(51)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt<span class="count">(0)</span> |</a></li>
                            <li class="pending"><a href="">Thùng rác<span class="count">(0)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = isset($_GET['num'])? ($_GET['num']-1)*$numOnPage : 0;
                                $end = isset($_GET['num'])? ($_GET['num']*$numOnPage)-1 : 9;
                                    for($i = $start; $i<= $end; $i++){
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $i+1 ?></h3></span>
                                    <td><span class="tbody-text masp"><?php echo $list_sanpham[$i]['MaSP'] ?></h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="../<?php echo $list_sanpham[$i]['Anh'] ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $list_sanpham[$i]['TenSP'] ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a class="delete" href="?page=delete_pro&id=<?php echo $list_sanpham[$i]['MaSP'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td style="text-align:center;"><span  class="tbody-text"><?php echo currency_format($list_sanpham[$i]['GiaKhuyenMai']>0 ? $list_sanpham[$i]['GiaKhuyenMai'] : $sp['GiaGoc']);?></span></td>
                                    <td><span class="tbody-text"><?php echo $list_sanpham[$i]['TenDM'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $list_sanpham[$i]['SoLuong']>0 ? "Còn hàng" : "Hết hàng" ?></span></td>
                                    <td><span class="tbody-text">Admin</span></td>
                                    <td><span class="tbody-text">--/--/----</span></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php if($numPage > 1){ ?>
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href='?page=list_media&num=<?php echo isset($_GET['num'])? $_GET['num']-1 :1; ?>' title=''><</a>
                        </li>
                        <?php
                        for($index = 1; $index <= $numPage; $index++){
                            echo
                            "<li>
                                <a href='?page=list_media&num=$index' title=''>$index</a>
                            </li>";
                        }
                        ?>
                        <li>
                            <a href='?page=list_media&num=<?php echo isset($_GET['num'])? $_GET['num']+1 :$numPage; ?>' title=''>></a>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>