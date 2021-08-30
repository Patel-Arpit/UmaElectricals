<?php
require_once('top.php');
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
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail"></th>
                                        <th class="product-name"><span class="nobr">ID</span></th>
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-price"><span class="nobr"> Address </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Type</span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Status</span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Order status</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $uid = $_SESSION['USER_ID'];
                                    
                                    $res = mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where `order`.user_id='$uid' and order_status.id=`order`.order_status"); 
                                    while($row = mysqli_fetch_assoc($res)){
                                    ?>
                                    <tr>
                                        <td class=""><a href="#"><img src="https://img.icons8.com/material-two-tone/24/000000/fast-cart.png"/></a></td>
                                        <td class="product-add-to-cart"><a href="my_order_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['id'] ?></a></td>
                                        <td class="product-name"><?php echo $row['added_on'] ?></td>
                                        <td class="product-name"><?php echo $row['address'] ?><br>
                                        <?php echo $row['city'] ?><br>
                                        <?php echo $row['pincode'] ?></td>
                                        <td class="product-name"><?php echo $row['payment_type'] ?></td>
                                        <td class="product-name"><?php echo $row['payment_status'] ?></td>
                                        <td class="product-name"><?php echo $row['order_status_str'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="wishlist-share">
                                                <h4 class="wishlist-share-title">Share on:</h4>
                                                <div class="social-icon">
                                                    <ul>
                                                        <li><a href="https://web.whatsapp.com/" target="_blank"><img src="https://img.icons8.com/color/50/000000/whatsapp.png"/></a></li>
                                                        <li><a href="#"><img src="https://img.icons8.com/fluency/48/000000/facebook-new.png"/></i></a></li>
                                                        <li><a href="#"><img src="https://img.icons8.com/fluency/50/000000/instagram-new.png"/></a></li>
                                                        <li><a href="#"><img src="https://img.icons8.com/color/48/000000/gmail-new.png"/></a></li>
                                                        <li><a href="#"><img src="https://img.icons8.com/color/50/000000/pinterest.png"/></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wishlist-area end -->



<?php
require_once('footer.php');
?>