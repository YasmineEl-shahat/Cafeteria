<?php

    include '../layout/navbar.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "../../guard/auth.php";
    include "../../models/category.php";
    include "../../models/product.php";
    include "../../models/cart.php";

    auth("../auth/login-form.php");

    $categoryObj = new Category();

    $categories = $categoryObj -> selectCategories();

    $productObj = new Product();

    $cart = new Cart();

    $cart_id = $cart -> get_user_Cart_id($_SESSION["user_id"])[0]->id;

    
?>


    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url(../../assets/images/bg_1.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-8 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">The Best Coffee Testing Experience</h1>
              <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url(../../assets/images/bg_2.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-8 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">Amazing Taste &amp; Beautiful Place</h1>
              <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url(../../assets/../../assets/images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-8 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">Creamy Hot and Ready to Serve</h1>
              <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>

          </div>
        </div>
      </div>
    </section>


    <section class="ftco-menu" id="menu">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Our Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">
		          <div class="col-md-12 nav-link-wrap mb-5">
		            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <?php foreach ($categories as $category) { ?>
                        <a class="nav-link <?php echo $category->id === 1 ? 'active' : ''; ?>" id="v-pills-<?php echo $category->id; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $category->id; ?>" role="tab" aria-controls="v-pills-<?php echo $category->id; ?>" aria-selected="<?php echo $category->id === 1 ? 'true' : 'false'; ?>">
                            <?php echo $category->name; ?>
                        </a>
                      <?php } ?>
                    </div>
		          </div>
		          <div class="col-md-12 d-flex align-items-center">
                    <div class="tab-content ftco-animate" id="v-pills-tabContent">
                        <?php foreach ($categories as $category) { ?>
                            <div class="tab-pane fade <?php echo $category->id === 1 ? 'show active' : ''; ?>" id="v-pills-<?php echo $category->id; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $category->id; ?>-tab">
                                <?php $products=$productObj -> selectProductsCategory($category->id); ?>
                            	<div class="d-flex justify-content-center align-items-center flex-wrap">
                                    <?php foreach ($products as $product) { ?>
                                        <div class="text-center" style="min-width:200px;margin-left:1rem">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4" style="background-image: url(<?php echo $product->image; ?>);"></a>
                                                <div class="text">
                                                    <h3><a href="#"><?php echo $product->name; ?></a></h3>
                                                    <p class="price"><span>$<?php echo $product->price; ?></span></p>
                                                    <p><a href="../../controller/cart/add-to-cart.php?cart_id=<?php echo $cart_id ;?>&product_id=<?php echo $product->id ;?>" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
		          </div>
		        </div>
		      </div>
		    </div>
    	</div>
    </section>

<?php
include '../layout/footer.php';
?>