<?php
session_start();
if (!empty($_SESSION) && $_SESSION['role'] == 1) {

    include '../layout/adminnavbar.php';
} else {
    include "../layout/navbar.php";
}

// include "../../models/category.php";
include "../../models/product.php";
include "../../models/cart.php";
include "../../models/user.php";


$productObj = new Product();

$cart = new Cart();
if (isset($_GET['userId'])) {
    var_dump($_GET['userId']);
    $cart_id = $cart->get_user_Cart_id($_GET['userId'])[0]->id;
    $userID = $_GET['userId'];
}

?>

<section class="ftco-section ">
    <div class="container">
        <h4 class="text-center">Add Order</h4>
        
        
        <div class="col-md-12 ">
            <form method="get" class="contact-form">
                <div class="form-group">
                    <section class="row">
                        <div class="col-12">
                            <label for="user">User Name</label>
                            <select id="user" name="userId" class="form-control">
                                <?php
                                $user = new User();
                                $users = $user->getAllUsers();
                                ?>
                                <?php
                                foreach ($users as $user) { ?>
                                    <option name="userId" value="<?php echo $user['id'] ?>" style="background-color:black"><?php echo $user['username'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </section>
                </div>
                <div class="form-group">
                    <section class="row">
                        <div class="col-12">
                            <button type="submit" name="search" class="btn btn-primary btn-outline-primary">Select</button>
                        </div>
                    </section>
            </form>
            <a href="../order/cart.php?user_id=<?php echo $userID; ?>" class="btn btn-primary btn-outline-primary" style="margin-left: 1rem;">Show Cart</a>
            <div class="form-group">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <?php
                            $products = $productObj->selectProducts();
                            ?>
                            <?php
                            foreach ($products as $product) { ?>
                                <div class="text-center" style="min-width:200px;margin-left:1rem; width:16rem">
                                    <div class="menu-wrap">
                                        <a href="#" class="menu-img img mb-4" style="background-image: url(<?php echo $product->image; ?>);"></a>
                                        <div class="text">
                                            <h3><a href="#"><?php echo $product->name; ?></a></h3>
                                            <p class="price"><span>$<?php echo $product->price; ?></span></p>
                                            <p>
                                                <a href="./../../controller/cart/admin-add-to-cart.php?cart_id=<?php echo $cart_id; ?>
                                                  &product_id=<?php echo $product->id; ?> " class="btn btn-primary btn-outline-primary">
                                                    Add to cart</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>