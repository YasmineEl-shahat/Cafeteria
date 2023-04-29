<?php
include '../layout/navbar.php';
include "../../models/category.php";
include "../../guard/adminAuth.php";
  adminAuth("../auth/login-form.php");
  
  if($_GET){ 
      $errors = json_decode($_GET['errors']);
      $old = json_decode($_GET['formvalues']);
      $errors = (array) $errors;
      $oldValues = (array) $old;
  }else $oldValues = [];
?>
<section class="ftco-section ">
<div class="container">
  <h4 class="text-center">Add Product</h4>
    <div class="col-md-6 ">
            <form method="post" action="../../controller/product/add-product.php" enctype="multipart/form-data" class="contact-form">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Product Name" name='name' value="<?php echo $oldValues['name'] ?? "" ?>">
	                </div>
                    <div class="text-danger"> <?php  if(isset($errors['name']))  echo $errors['name']; ?></div>
	                <div class="form-group">
	                  <input type="number" class="form-control" placeholder="Product Price" name='price' value="<?php echo $oldValues['price'] ?? "" ?>">
	                </div>
                  <div class="text-danger"> <?php  if(isset($errors['price']))  echo $errors['price']; ?></div>
                  <div class="form-group">
	                  <input type="text" class="form-control" placeholder="unavailable" name='available' value="<?php echo $oldValues['availability'] ?? "" ?>">
	                </div>
                  <div class="text-danger"> <?php  if(isset($errors['available']))  echo $errors['available']; ?></div>
                  <section class="row">
                    <div class="col-6">
                    <label for="category">Product Category</label>
                    <select id="category" name="category" class="form-control" name='category[]'>
                    <?php
                        $category = new Category();
                        $categories = $category->selectCategories();?>
                        <?php
                        foreach ($categories as $category) { ?>
                            <option value="<?php echo $category->name ?>" style="background-color:gray"><?php echo $category->name ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="text-center">
                <input type="button" value="Add Category " class="btn btn-primary py-3 px-5" onclick="redirectToNewPage()">
                <script>
                    function redirectToNewPage() {
                      window.location.href = "./../category/add-categoryForm.php";
                    }
                  </script>

                </div>
                    </select>
                  </section>
               <div class="form-group">
                <input type="file" class="form-control" placeholder="image" name="product_image">
              </div>
              <div class="form-group">
                <input type="submit" value="Add Product " class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
</section>
<?php
include '../layout/footer.php';
?>