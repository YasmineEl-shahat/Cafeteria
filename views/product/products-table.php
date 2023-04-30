<?php
include '../layout/navbar.php';
// include '../layout/home-slider.php';
include "../../models/product.php";
include "../../models/category.php";
include "../../guard/adminAuth.php";
adminAuth("../auth/login-form.php");

?>
<section class="ftco-section ">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Products</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product </th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th col='3'>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $product = new Product();
   
                    $products = $product -> selectProducts();
                    
                      
                    foreach ($products as $product) {
                        $categoryId = $product->category_id;
                        $category = new Category();
                        $categoryName = $category->selectCategoryNameById($categoryId);

                        echo "<tr><td>{$product->id}</td>
                                  <td>{$product->name}</td>
                                  <td>{$product->price}</td>
                                  <td><img src={$product->image} width='50px' height='50px' alt='image'></td>
                                  <td>{$categoryName}</td>";
                        
                        $edit_url="edit-form.php?id={$product->id}";
                        echo "<td> <a href='"."{$edit_url}". "' class='btn btn-info'> Edit</a> </td>";
                        $edit_url="../../controller/edit-available.php?availaility={$product->availability}&id={$product->id}";
                        echo "<td> <a href='"."{$edit_url}". "' class='btn btn-success'>{$product->availability}</a> </td>";
                        
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
<input type="button" value="Add Product " class="btn btn-primary py-3 px-5 m-auto" onclick="redirectToNewPage()">
<script>
    function redirectToNewPage() {
      window.location.href = "./add-productForm.php";
    }
  </script>
</section>

<?php
include '../layout/footer.php';
?>