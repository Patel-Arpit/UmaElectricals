<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$pid =  get_safe_value($con, $_POST['pid']);
$type =  get_safe_value($con, $_POST['type']);


if (isset($_SESSION['USER_LOGIN'])) {

    $uid = $_SESSION['USER_ID'];
    if (mysqli_num_rows(mysqli_query($con, "select * from wishlist where user_id='$uid' and product_id='$pid'")) > 0) {
        // echo "added";
    } else {
        // $added_on = date('Y-m-d h:m:s');
        // mysqli_query($con, "INSERT INTO `wishlist`(`user_id`, `product_id`, `added_on`) VALUES ('$uid','$pid','$added_on')");
        wishlist_add($con,$uid,$pid);
        // echo "add";
    }
    $total_record = mysqli_num_rows(mysqli_query($con, "select * from wishlist where user_id='$uid' and product_id='$pid'"));
} else {
    $_SESSION['WISHLIST_ID'] = $pid;
    echo "not_login";
}
?>