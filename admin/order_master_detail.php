<?php
require('top.inc.php');

$order_id = get_safe_value($con, $_GET['id']);

if(isset($_POST['update_order_status'])){
    $update_order_status=$_POST['update_order_status'];
    mysqli_query($con,"update `order` set order_status='$update_order_status' where id='$order_id'");
}

?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Details </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Nmae</th>
                                        <th class="product-thumbnail">product Image</th>
                                        <th class="product-name">QTY</th>
                                        <th class="product-name">Price</th>
                                        <th class="product-price">Total Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($con, "select distinct(order_detail.id) ,order_detail.*,product.name,product.image from order_detail,product, `order` where order_detail.order_id='$order_id' and order_detail.product_id=product.id");
                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $total_price = $total_price + ($row['qty'] * $row['price']);
                                    ?>
                                        <tr>
                                            <td class="product-name"><?php echo $row['name'] ?></td>
                                            <td class="product-name"><img src="../media/product/<?php echo $row['image'] ?>"></td>
                                            <td class="product-name"><?php echo $row['qty'] ?></td>
                                            <td class="product-name"><?php echo $row['price'] ?></td>
                                            <td class="product-name"><?php echo $row['qty'] * $row['price'] ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Total Price</td>
                                        <td class="product-name"><?php echo $total_price; ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <div id="address_details">
                                <strong>Address :</strong>
                                <?php
                                $res = mysqli_query($con, "SELECT * FROM `order` WHERE id='$order_id'");
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $address = $row['address'];
                                    $city = $row['city'];
                                    $pincode = $row['pincode'];
                                    echo '<br>';
                                    echo  $address . '  ' . $city . '  ' . $pincode;
                                }
                                ?><br> <br>
                                <strong>Order Status :</strong>
                                <?php
                                $order_sataus_arr = mysqli_fetch_assoc(mysqli_query($con, "select order_status.name from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id"));
                                echo $order_sataus_arr['name'];
                                ?>

                                <div>
                                    <form action="" method="POST">
                                        <select name="update_order_status" id="" class="form-control">
                                            <option value="">Select Status</option>
                                            <?php
                                            $res = mysqli_query($con, "select * from order_status");
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                if ($row['id'] == $categories_id) {
                                                    echo " <option selected value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                } else {
                                                    echo " <option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select><br>
                                        <input type="submit" class="form-control">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>