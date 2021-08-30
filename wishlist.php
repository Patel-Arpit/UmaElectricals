<?php
require('top.php');

$uid = $_SESSION['USER_ID'];
if (!isset($_SESSION['USER_LOGIN'])) {
    header('location: index.php');
}


$res = mysqli_query($con, "select product.name,product.image,product.price,product.mrp,product.id,wishlist.id,wishlist.product_id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");

// prx($_SESSION);    //check the Quantity of product and product ID
?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('media/cate_img/back.jpg') no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Wishlist</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $product_id = $row['product_id'];
                                ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="product.php?id=<?php echo $product_id ?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image']; ?>" alt="product img" /></a></td>
                                        <td class="product-name"><a href="#"><?php echo $row['name'] ?></a>
                                            <ul class="pro__prize">
                                                <li class="old__prize"><?php echo $row['mrp'] . '<i class="las la-rupee-sign"></i>' ?></li>
                                                <li><?php echo $row['price'] . '<i class="las la-rupee-sign"></i>' ?></li>
                                            </ul>
                                        </td>
                                        <td class="product-price"><span class="amount"><?php echo $row['price'] . '<i class="las la-rupee-sign"></i>' ?></span></td>
                                        <td class="product-remove"><a href="wishlist.php?wishlist_id=<?php echo $row['id']; ?>"><i class="icon-trash icons"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="index.php">Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->



<?php
require('footer.php');
?>