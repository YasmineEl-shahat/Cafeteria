<?php
include '../layout/adminnavbar.php';
include "../../models/order.php";
include '../../models/product.php';
include "../../models/user.php";
include '../../models/cart.php';
include "../../guard/adminAuth.php";
// const User = require('../../controller/user/');
adminAuth("../auth/login-form.php");

if ($_GET) {
    $errors = json_decode($_GET['errors']);
    $old = json_decode($_GET['formvalues']);
    $errors = (array) $errors;
    $oldValues = (array) $old;
} else $oldValues = [];

if (isset($_POST['search'])) {
    $prod = new Product();
    $products = $prod->selectProducts();
    foreach ($products as $product) {
        if (stripos($product['name'], $part) !== false) {
            $products[] = $product;
        }
    }
    return $products;
} else {
    $prod = new Product();
    $products = $prod->selectProducts();
}

?>
<section class="ftco-section ">
    <div class="container">
        <h4 class="text-center">Add Order</h4>
        <div class="col-md-6 ">
            <form method="post" action="../../controller/order/add-order.php" class="contact-form">
                <div class="form-group">
                    <section class="row">
                        <div class="col-6">
                            <label for="user">User Name</label>
                            <select id="user" name="user" class="form-control">
                                <?php
                                $user = new User();
                                $users = $user->getAllUsers();
                                ?>
                                <?php
                                foreach ($users as $user) { ?>
                                    <option value="<?php echo $user['id'] ?>" style="background-color:black"><?php echo $user['username'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </section>
                </div>
                <div class="form-group">
                    <section class="row">
                        <div class="col-6">
                            <label for="product">Products</label>
                            <select id="product" name="product" multiple class="form-control">
                                <?php
                                foreach($products as $product) { ?>
                                    <option value="<?php echo $product->id ?>" style="background-color:black"><?php echo $product->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
// include '../layout/footer.php';
?> -->
<?php
