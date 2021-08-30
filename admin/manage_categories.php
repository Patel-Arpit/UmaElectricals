<?php
require('top.inc.php');
$categories = '';
echo '<pre>';
print_r($_GET['id']);
die;
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from categories where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check) {
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];
    } else {
        header('location: categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories = get_safe_value($con, $_POST['categories']);
    $res = mysqli_query($con, "SELECT * FROM categories WHERE categories = '$categories'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        echo '  <div class="alert alert-warning alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong> Categories Already Exit
                </div>';
    } else {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $sql = mysqli_query($con, "UPDATE categories set categories='$categories' where id='$id'");
        } else {
            $sql = mysqli_query($con, "INSERT INTO categories(categories,status) values ('$categories','1')");
        }
        header('location: categories.php');
        die();
    }
}

?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Categories</strong><small> Form</small>
                    </div>
                    <form action="" method="post">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Categories</label>
                                <input type="text" id="company" name="categories" placeholder="Enter Categories Name" class="form-control" value="<?php echo $categories ?>" required>
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-success btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>