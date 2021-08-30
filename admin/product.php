<?php 
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type'] != ''){
    $type = get_safe_value($con, $_GET['type']);
    if($type == 'status'){
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if($operation == 'active'){
            $status = '1';
        }else{
            $status = '0';
        }
        $update_status = "update product set status='$status' where id='$id'";
        mysqli_query($con, $update_status);
    }
    if($type == 'delete'){
        $id = get_safe_value($con, $_GET['id']);
        $delete_status = "delete from product where id='$id'";
        mysqli_query($con, $delete_status);
    }
}
$sql = "select product.*,categories.categories,product.best_seller from product,categories where product.categories_id=categories.id order by product.id desc";
$res = mysqli_query($con,$sql);

?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Product</h4>
                        <h4 class="box-link"><a href="manage_product.php">Add Product</a> </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table " id="myDataTable">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Best Seller</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php 
                                $i=0;
                                while($row = mysqli_fetch_assoc($res)){?>
                                    <tr>
                                        
                                        <td class="serial"><?php echo $i += 1; ?></td>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['categories']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <?php  ?>
                                        <td><img src="../media/product/<?php echo $row['image'];?>"/></td>
                                        <td><?php echo $row['mrp']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['qty']; ?></td>
                                        <td><?php echo $row['best_seller']; ?></td>
                                        <td><?php 
                                        if($row['status']==1){
                                            echo "<button class='btn btn-success'><a style='color: white;' href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></button>&nbsp&nbsp";
                                        }else{
                                            echo "<button class='btn btn-success'><a style='color: white;' href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></button>&nbsp&nbsp";
                                        }
                                        echo "<button class='btn btn-primary'><a style='color: white;' href='manage_product.php?id=".$row['id']."'>Edit</a></button>&nbsp&nbsp";

                                        echo "<button class='btn btn-danger'><a style='color: white;' href='?type=delete&id=".$row['id']."'>Delete</a></button>";
                                        ?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
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
