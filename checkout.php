<?php
require_once('top.php');

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php }

$cart_total = 0;

if (isset($_POST['submit'])) {
    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $pincode = get_safe_value($con, $_POST['pincode']);
    $payment_type = get_safe_value($con, $_POST['payment_type']);
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        $cart_total = $cart_total + ($price * $qty);
    }
    $user_id = $_SESSION['USER_ID'];
    $total_price = $cart_total;
    $payment_status = 'pending';
    if ($payment_type == 'COD') {
        $payment_status = 'success';
    }
    $order_status = '1';
    $added_on = date('Y-m-d h:i:s');

    mysqli_query($con, "insert into `order` (user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')");

    $order_id = mysqli_insert_id($con);

    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];

        mysqli_query($con, "insert into `order_detail` (order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
    }
    unset($_SESSION['cart']);
?>
    <script>
        window.location.href = 'thank_you.php';
    </script>
<?php
}
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
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">

                            <?php
                            $accordion_class = 'accordion__title';
                            if (!isset($_SESSION['USER_LOGIN'])) {
                                $accordion_class = 'accordion__hide';
                            ?>
                                <div class="accordion__title">
                                    Checkout Method
                                </div>
                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form action="login-form" method="POST">
                                                        <h5 class="checkout-method__title">Login</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                                        </div>
                                                        <span class="field_error" id="login_email_error"></span>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                                        </div>
                                                        <span class="field_error" id="login_password_error"></span>
                                                        <p class="require">* Required fields</p>
                                                        <div class="dark-btn">
                                                            <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                        </div>
                                                    </form>
                                                    <div class="form-output login_msg">
                                                        <p class="form-messege field_error"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form action="#">
                                                        <h5 class="checkout-method__title">Register</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Name</label>
                                                            <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="name_error"></span>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="email" id="email" placeholder="Your Email*" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="email_error"></span>
                                                        <div class="single-input">
                                                            <label for="user-email">Mobile Number</label>
                                                            <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="mobile_error"></span>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="password_error"></span>
                                                        <div class="dark-btn">
                                                            <button type="button" onclick="user_register()" class="fv-btn">Register</button>
                                                        </div>
                                                    </form>
                                                    <div class="form-output register_msg">
                                                        <p class="form-messege field_error"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="<?php echo $accordion_class; ?>">
                                Address Information
                            </div>
                            <form method="post">
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="address" placeholder="Street Address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="city" placeholder="City/State" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="pincode" placeholder="Post code/ zip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="<?php echo $accordion_class; ?>">
                                    payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            <!-- <a href="#"><i class="zmdi zmdi-long-arrow-right"></i>Check/ Money Order</a> -->
                                            <input type="radio" name="payment_type" id="" value="COD" required>&nbsp; COD &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="payment_type" id="" value="payu" required>&nbsp; PayU
                                        </div>
                                        <div class="single-method">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success order_btn" name="submit" value="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        $cart_total = 0;
                        foreach ($_SESSION['cart'] as $key => $val) {
                            $productArr = get_product($con, '', '', $key);
                            // pr($productArr);    //check the product all details
                            $pname = $productArr[0]['name'];
                            $mrp = $productArr[0]['mrp'];
                            $price = $productArr[0]['price'];
                            $image = $productArr[0]['image'];
                            $qty = $val['qty'];
                            $cart_total = $cart_total + ($price * $qty);

                        ?>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?php echo $pname ?></a>
                                    <span class="price"><?php echo $price * $qty . '<i class="las la-rupee-sign"></i>' ?></span>
                                </div>
                                <div class="single-item__remove">
                                    <!-- <a href="#"><i class="zmdi zmdi-delete"></i></a> -->
                                    <a href="javascript:void(0)" onclick="manage_to_cart('<?php echo $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?php echo $cart_total . '<i class="las la-rupee-sign"></i>' ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->



<?php
require_once('footer.php')

?>