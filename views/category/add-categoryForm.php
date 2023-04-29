<?php
include '../layout/navbar.php';
include "../../guard/adminAuth.php";
  adminAuth("../auth/login-form.php");
  
  if($_GET){ 
      $errors = json_decode($_GET['errors']);
      $old = json_decode($_GET['old']);
      $errors = (array) $errors;
      $oldValues = (array) $old;
  }
  else $oldValues = [];
?>
<section class="ftco-section ">
<div class="container">
    <div class="col-md-6 ">
            <form method="post" action="../../controller/category/add-category.php" enctype="multipart/form-data" class="contact-form">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Category Name" name='name'>
	                </div>
              <div class="form-group">
                <input type="submit" value="Add Category " class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
</section>
<?php
include '../layout/footer.php';
?>