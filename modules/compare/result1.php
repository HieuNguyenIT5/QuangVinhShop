<?php
session_start();
if(isset($_SESSION['search'])){
    $sql = "SELECT masp, tensp FROM sanpham where tensp like '%{$_SESSION['search']}%'";
    unset($_SESSION['search']);
}else if(isset($_POST['search'])){
    $sql = "SELECT masp, tensp FROM sanpham where tensp like '%{$_POST['search']}%'";
}else $sql = "SELECT masp, tensp FROM sanpham";
$result = mysqli_query($conn, $sql);
$list = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
}

foreach($list as $item){
    echo "<li class='product-title'>{$item['tensp']} <span>{$item['masp']}</span></li>";
}