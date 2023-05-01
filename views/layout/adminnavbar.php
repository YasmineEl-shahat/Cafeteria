<?php
session_start();
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

  <style>
    /* Hide all nested tables by default */
    .nested-table {
      display: none;
    }

    /* Show a nested table when it has the "nested-table-visible" class */
    .nested-table-visible {
      display: table;
    }

    /* Style the icons */
    .fas {
      cursor: pointer;
    }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">Coffee<small>Blend</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="../home/index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="../product/products-table.php" class="nav-link">Products</a></li>
          <li class="nav-item"><a href="../user/users-table.php" class="nav-link">Users</a></li>
          <li class="nav-item"><a href="../userOrders/userOrders.php" class="nav-link">Search</a></li>
          <li class="nav-item"><a href="../order/admin-orders.php" class="nav-link">Orders</a></li>
          <li class="nav-item"><a href="../category/add-categoryForm.php" class="nav-link">Add Category</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="../../controller/auth/logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- END nav -->