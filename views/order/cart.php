<?php

    include '../layout/adminnavbar.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "../../models/cart.php";
    $userID = $_GET["user_id"];
    $cart = new Cart();
    $cart_id = $cart -> get_user_Cart_id($userID)[0]->id;

    $items = $cart -> get_Cart_items($cart_id);
    $total = $cart -> getTotalPrice($cart_id)[0]->total;
 
?>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item) { ?>
                            <tr class="text-center">
                                <td class="product-remove">
                                    <a href="../../controller/cart/remove-from-cart.php?cart_id=<?php echo $cart_id ;?>&product_id=<?php echo $item->product_id ;?>"><span class="icon-close"></span></a></td>
                                
                                <td class="image-prod"><div class="img" style="background-image:url(<?php echo $item->image; ?>);"></div></td>
                                
                                <td class="product-name">
                                    <h3><?php echo $item -> name; ?></h3>
                                </td>
                                
                                <td class="price"><?php echo $item -> price; ?></td>
                                
                                <td class="quantity">
                                    <div class="input-group mb-3">
                                    <form action="../../controller/cartItem/adminchangeQuantity.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $userID; ?>">
                                        <input type="number" name="quantity" class="quantity form-control input-number" value="<?php echo $item->quantity; ?>" min="1" max="100">
                                        <button style="color:white !important" type="submit" class="btn btn-primary py-3 px-4">Update Quantity</button>
                                    </form>
                                    </div>
                                </td>
                                
                                <td class="total"><?php echo $item -> price * $item -> quantity; ?></td>
                            </tr><!-- END TR-->
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span>$<?php echo $total; ?></span>
                    </p>
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span>$0.00</span>
                    </p>
                    <p class="d-flex">
                        <span>Discount</span>
                        <span>$3.00</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span>$<?php echo $total-3.00; ?></span>
                    </p>
                </div>
                <p class="text-center"><a href="../../controller/order/add-order.php?cart_id=<?php echo $cart_id ?>" class="btn btn-primary py-3 px-4">Proceed Order</a></p>
            </div>
        </div>
    </div>
</section>


<?php
include './../layout/footer.php';
?>