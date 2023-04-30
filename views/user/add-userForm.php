<?php

include "../../views/layout/navbar.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../../guard/adminAuth.php";

adminAuth("../auth/login-form.php");

if ($_GET) {
  $errors = json_decode($_GET['errors']);
  $old = json_decode($_GET['old']);
  $errors = (array) $errors;
  $oldValues = (array) $old;
} else $oldValues = [];
?>

<section class="ftco-section ">
  <div class="container mt-5">
    <div class="row block-9">
      <div class="col-md-12 ftco-animate">

        <h1> Add new User</h1>
        <form method="post" action="../../controller/user/add-user.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" class="form-control" name='username' id="exampleInputName" value="<?php echo $oldValues['username'] ?? "" ?>">
            <div class="text-danger"> <?php if (isset($errors['username']))  echo $errors['username']; ?></div>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" name='email' id="exampleInputEmail1" value="<?php echo $oldValues['email'] ?? "" ?>">
            <div class="text-danger"> <?php if (isset($errors['email']))  echo $errors['email']; ?></div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name='password' class="form-control" id="exampleInputPassword1">
            <div class="text-danger"> <?php if (isset($errors['password']))  echo $errors['password']; ?></div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
            <input type="password" name='confirm-password' class="form-control" id="exampleInputPassword2">
            <div class="text-danger"> <?php if (isset($errors['confirm-password']))  echo $errors['confirm-password']; ?></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Room No. </label>
            <select name="room" class="form-control">
              <option value="" disabled>select room</option>
              <option <?= $oldValues && $oldValues['room'] == 'Application1' ? ' selected="selected"' : ''; ?> value="Application1">Application1</option>
              <option <?= $oldValues && $oldValues['room'] == 'Application2' ? ' selected="selected"' : ''; ?> value="Application2">Application2</option>
              <option <?= $oldValues && $oldValues['room'] == 'cloud' ? ' selected="selected"' : ''; ?> value="cloud">cloud</option>
            </select>
            <div class="text-danger"> <?php if (isset($errors['room']))  echo $errors['room']; ?></div>

          </div>
          <div class="mb-3">
            <label class="form-label">profile picture</label>
            <input class="form-control" type="file" name="profile-pic" value="<?php echo $oldValues['profile-pic'] ?? "" ?>" />
            <div class="text-danger"> <?php if (isset($errors['profile-pic']))  echo $errors['profile-pic']; ?></div>
          </div>
          <button type="submit" class="btn">Save</button>
          <button type="reset" class="btn">reset</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
include '../layout/footer.php';
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->