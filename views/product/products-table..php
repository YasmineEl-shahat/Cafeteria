<?php
include '../layout/navbar.php';
// include '../layout/home-slider.php';
include "../../models/product.php";
include "../../guard/adminAuth.php";
adminAuth("../auth/login-form.php");

?>
<section class="ftco-section ">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Orders</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product </th>
                        <th>Price</th>
                        <th>Image</th>
                        <th col='3'>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $product = new Product();
   
                    $products = $product -> selectProducts();
                    
                      
                    foreach ($products as $product) {
                        echo "<tr><td>{$product->id}</td>
                                  <td>{$product->name}</td>
                                  <td>{$product->price}</td>
                                  <td><img src={$product->image} width='50px' height='50px' alt='image'></td>
                                  <td>{$product->category}</td>";
                   
                        $edit_url="edit-form.php?id={$product->id}";
                        echo "<td> <a href='"."{$edit_url}". "' class='btn btn-info'> Edit</a> </td>";
                        
                        $delete_url="../../controller/product/delete-product.php?id={$product->id}";
                        echo "<td> <a href='"."{$delete_url}". "' class='btn btn-danger'> Delete</a> </td>";
                        
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>

<?php
include '../layout/footer.php';
?>