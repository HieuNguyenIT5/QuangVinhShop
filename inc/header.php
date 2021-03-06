<?php
session_start();
if(isset($_POST['btn-search'])){
    redirect("?mod=products&act=search&search={$_POST['s']}");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="uploads/logo-title.png" />
        <title>QUANG VINH STORE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/account.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>
        
        
        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <!--  -->
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-body" class="clearfix">
                    <div class="top-login">
                                <div class="socail">
                                <i class="fa fa-facebook-f"></i>
                                <i class="fa fa-twitter"></i>
                                <i class="fa fa-envelope"></i>
                                </div>
                                <?php
                                if (isset($_SESSION['is_login'])) {
                                    echo "
                                    <div class='top-content'>
                                    <a>Xin ch??o {$_SESSION['is_fullname']}</a>
                                    <ul>
                                        <li><a href='?mod=account&act=detail'>Th??ng tin t???i kho???n</a></li>";
                                    if(isset($_SESSION['permission']) & $_SESSION['permission'] ==0)
                                        echo "<li> <a href='./admin'>Qu???n l?? c???a h??ng</a></li>";
                                    
                                    echo "<li><a href='?mod=order&act=order_list'>????n mua</a></li>";
                                    echo "<li><a href='?mod=account&act=logout'>????ng xu???t</a></li>
                                    </ul>
                                    </div>";
                                }else{
                                    echo "<a href='?mod=account&act=login'>????ng nh???p</a>";
                                }
                                ?>    
                        </div>
                        <div class="header-top wp-inner">
                            
                        </div>
                        <div class="wp-inner">
                            <a href="?page=home" title="" id="logo" class="fl-left"><img src="uploads/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="POST" action="">
                                    <input type="text" name="s" id="s" placeholder="Nh???p t??? kh??a t??m ki???m t???i ????y!">
                                    <button name="btn-search" type="submit" id="sm-s"><i class=" fa fa-search"></i></button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">T?? v???n</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <?php if(isset($_SESSION['id_user'])){?>
                                <a href="?mod=cart" title="gi??? h??ng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">2</span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <?php
                                        $num = get_num_pro_in_cart();
                                        $cart = getCart($_SESSION['id_user']);
                                    ?>
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num"><?php echo $num ?></span>
                                    </div>
                                    
                                    <div id="dropdown">
                                        <p class="desc">C?? <span><?php echo $num ?> s???n ph???m</span> trong gi??? h??ng</p>
                                        <ul class="list-cart">
                                            <?php
                                            foreach($cart as $item){
                                            ?>
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="<?php echo $item['Anh'] ?>" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title="" class="product-name"><?php echo $item['TenSP'] ?></a>
                                                    <p class="price"><?php echo currency_format($item['GiaKhuyenMai']>0 ? $item['GiaKhuyenMai']:$item['GiaGoc']); ?></p>
                                                    <p class="qty">S??? l?????ng: <span><?php echo $item['SoLuong'] ?></span></p>
                                                </div>
                                            </li>
                                            <?php }?>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">T???ng:</p>
                                            <p class="price fl-right"><?php echo currency_format(get_total_cart())?></p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="?mod=cart" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
                                            <a href="?mod=cart&act=checkout" title="Thanh to??n" class="checkout fl-right">Thanh to??n</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="head-buttom" class=" ">
                        <div class="wp-inner">
                            <div id="main-menu-wp" class="d-flex d-flex justify-content-center ">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="?mod=home" title="">Trang ch???</a>
                                    </li>
                                    <li>
                                        <a href="?mod=products" title="">S???n ph???m</a>
                                    </li>
                                    <li>
                                        <a href="?mod=compare" title="">So s??nh gi??</a>
                                    </li>
                                    <li>
                                        <a href="?mod=promotion" title="">Khuy???n m??i</a>
                                    </li>
                                    <li>
                                        <a href="?mod=post" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="?mod=detail_blog" title="">Gi???i thi???u</a>
                                    </li>
                                    <li>
                                        <a href="?mod=contact" title="">Li??n h???</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>