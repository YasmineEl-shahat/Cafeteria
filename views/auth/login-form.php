<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!empty($_SESSION)) {
    header("Location:../home");
}

if ($_GET) {
    $error = json_decode($_GET['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coffee - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/animate.css">

    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css">

    <link rel="stylesheet" href="../../assets/css/aos.css">

    <link rel="stylesheet" href="../../assets/css/ionicons.min.css">

    <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../assets/css/jquery.timepicker.css">


    <link rel="stylesheet" href="../../assets/css/flaticon.css">
    <link rel="stylesheet" href="../../assets/css/icomoon.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        label{
            color:#fff;
        }
        </style>
</head>

<body>
    <section class="ftco-section ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Login Form</h1>
                    <form method="post" action="../../controller/auth/login.php">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" name='email' id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name='password' class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="text-danger"> <?php if (isset($error))  echo $error; ?></div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>