<?php
    include "../../models/product.php";
    include "../../models/category.php";
    include '../layout/adminnavbar.php'; 
    include "../../guard/adminAuth.php";

    adminAuth("../auth/login-form.php");
    
    $product_id = $_GET['id'];
    $product = new Product();
    $product = $product->select_product($product_id);

    $edit_url="../../controller/product/edit-product.php?id={$product_id}";
    $img = $product['image'];
    $edit_url .= "&imgPath={$img}";

    if($_GET && array_key_exists("errors", $_GET)){
        $errors = json_decode($_GET['errors']);
        $errors = (array) $errors;
    }

    ?>
<section class="ftco-section ">
<div class="container">
  <h4 class="text-center">Edit Product</h4>
    <div class="col-md-6 ">
            <form method="post" action="<?php echo $edit_url; ?>" enctype="multipart/form-data" class="contact-form">
	                <div class="form-group">
	                  <input type="text" class="form-control" value='<?php echo $product['name']; ?>' name='name'>
	                </div>
                    <div class="text-danger"> <?php  if(isset($errors['name']))  echo $errors['name']; ?></div>
	                <div class="form-group">
	                  <input type="number" class="form-control" value='<?php echo $product['price']; ?>' name='price'>
	                </div>
                    <div class="text-danger"> <?php  if(isset($errors['price']))  echo $errors['price']; ?></div>
                  <div class="form-group">
	                  <input type="text" class="form-control"value='<?php echo $product['availability']; ?>' name='availability'>
	                </div>
                    <div class="text-danger"> <?php  if(isset($errors['availability']))  echo $errors['availability']; ?></div>
                    <div class="form-group">
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
               <div class="form-group">
                <input type="file" class="form-control" value='<?php echo $product['image']; ?>' name="product_image">
              </div>
              <div class="form-group">
                <input type="submit" value="Save Changes " class="btn btn-primary py-3 px-5">
                <input type="reset" value="Reset " class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
</section>
<?php
include '../layout/footer.php';
?>