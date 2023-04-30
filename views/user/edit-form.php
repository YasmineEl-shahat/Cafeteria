<?php
include "../../views/layout/navbar.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../../models/user.php";


include "../../guard/adminAuth.php";

adminAuth("../auth/login-form.php");

$user_id = $_GET['id'];
$edit_url = "../../controller/user/edit-user.php?id={$user_id}";

// connect to database
$user = new User();


if (array_key_exists("old", $_GET)) {
    $old = json_decode($_GET['old']);
    $oldValues = (array) $old;
    if (array_key_exists("errors", $_GET)) {
        $errors = json_decode($_GET['errors']);
        $errors = (array) $errors;
    }
} else {
    $oldValues = $user->select_user($user_id);
    $img = $oldValues["profile-pic"];
    $edit_url .= "&imgPath={$img}";
}
?>

<section class="ftco-section ">
    <div class="container mt-5">
        <div class="row block-9">
            <div class="col-md-12 ftco-animate">

                <h1> Edit User</h1>

                <form method="post" action="<?php echo $edit_url; ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name='username' id="exampleInputName" value="<?php echo $oldValues['username'] ?? "" ?>">
                        <div class="text-danger"> <?php if (isset($errors['username'])) {
                                                        echo $errors['name'];
                                                    } ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name='email' id="exampleInputEmail1" value="<?php echo $oldValues['email'] ?? "" ?>">
                        <div class="text-danger"> <?php if (isset($errors['email'])) {
                                                        echo $errors['email'];
                                                    } ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name='password' class="form-control" id="exampleInputPassword1">
                        <div class="text-danger"> <?php if (isset($errors['password'])) {
                                                        echo $errors['password'];
                                                    } ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                        <input type="password" name='confirm-password' class="form-control" id="exampleInputPassword2">
                        <div class="text-danger"> <?php if (isset($errors['confirm-password'])) {
                                                        echo $errors['confirm-password'];
                                                    } ?></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Room No. </label>
                        <select name="room" class="form-control">
                            <option value="" disabled>select room</option>
                            <option <?= $oldValues &&  $oldValues['room'] == 'Application1' ? ' selected="selected"' : ''; ?> value="Application1">Application1</option>
                            <option <?= $oldValues &&  $oldValues['room'] == 'Application2' ? ' selected="selected"' : ''; ?> value="Application2">Application2</option>
                            <option <?= $oldValues &&  $oldValues['room'] == 'cloud' ? ' selected="selected"' : ''; ?> value="cloud">cloud</option>
                        </select>
                        <div class="text-danger"> <?php if (isset($errors['room'])) {
                                                        echo $errors['room'];
                                                    } ?></div>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">profile picture</label>
                        <input class="form-control" type="file" name="profile-pic" value="<?php echo $oldValues['profile-pic'] ?? "" ?>" />
                        <div class="text-danger"> <?php if (isset($errors['profile-pic'])) {
                                                        echo $errors['profile-pic'];
                                                    } ?></div>
                    </div>
                    <button type="submit" class="btn btn">Save</button>
                    <button type="reset" class="btn btn">reset</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
include '../layout/footer.php';
?>