<?php

include 'components/connect.php';


if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

// include 'components/wishlist_cart.php';
include 'components/header.php';

?>


<!--MAIN SLIDE-->
<div class="wrap-main-slide" style="width: 80%; margin-left:10%;">
   <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
      <div class="item-slide">
         <img src="assets/images/main-slider-1-1.jpg" alt="" class="img-slide">
         <div class="slide-info slide-1">
            <h2 class="f-title">Kid Smart <b>Watches</b></h2>
            <span class="subtitle">Compra todos tus productos Smart por internet.</span>
            <p class="sale-info">Only price: <span class="price">59.99 Dhs</span></p>
            <a href="shop.php" class="btn-link">Shop Now</a>
         </div>
      </div>
      <div class="item-slide">
         <img src="assets/images/main-slider-1-2.jpg" alt="" class="img-slide">
         <div class="slide-info slide-2">
            <h2 class="f-title">Extra 25% Off</h2>
            <span class="f-subtitle" style="color:white">On online payments</span>
            <p class="discount-code"></p>
            <h4 class="s-title">Get Free</h4>
            <p class="s-subtitle">TRansparent Bra Straps</p>
         </div>
      </div>
      <div class="item-slide">
         <img src="assets/images/main-slider-1-3.jpg" alt="" class="img-slide">
         <div class="slide-info slide-3">
            <h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
            <span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
            <p class="sale-info">Stating at: <b class="price">225.00 Dhs</b></p>
            <a href="#" class="btn-link">Shop Now</a>
         </div>
      </div>
   </div>
</div>

<!--BANNER-->
<div class="wrap-banner style-twin-default" style="width: 80%; margin-left:10%;">
   <div class="banner-item">
      <a href="#" class="link-banner banner-effect-1">
         <figure><img src="assets/images/home-1-banner-1.jpg" alt="" width="580" height="190"></figure>
      </a>
   </div>
   <div class="banner-item">
      <a href="#" class="link-banner banner-effect-1">
         <figure><img src="assets/images/home-1-banner-2.jpg" alt="" width="580" height="190"></figure>
      </a>
      <br></br>
   </div>

</div>

<section class="category">

   <h1 class="heading">Shop by category</h1>

   <div class="swiper category-slider">

      <div class="swiper-wrapper">

         <?php
         $categories = $conn->prepare("SELECT * FROM `categories`");
         $categories->execute();
         if ($categories->rowCount() > 0) { ?>
            <?php
            foreach ($categories as $categorie) {
            ?>
               <a href="category.php?category=<?php echo $categorie['category'] ?>" class="swiper-slide slide">
                  <h3> <?php echo $categorie['category'] ?></h3>
               </a>

         <?php

            }
         }
         ?>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>




<section class="products" style=" margin-top: -30px; ">

   <h1 class="heading">latest products</h1>

   <div class="box-container" style=" border-color: white; ">

      <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 12");
      $select_products->execute();
      if ($select_products->rowCount() > 0) {
         while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" name="form-<?= $fetch_product['id']; ?>" method="post" class="box" style=" border-color: white;">
               <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
               <button class="fas fa-heart" onclick="to_wishlist('form-<?= $fetch_product['id']; ?>')" style="border-color: white; background-color: white; color: #FA6868 ;" type="button" name="add_to_wishlist"></button>
               <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" style="border-color: white; color: black; background-color: white;" class="fas fa-eye"></a>
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <div class="name"><?= $fetch_product['name']; ?></div>
               <div class="flex">
                  <div class="price" style=" color: #063970; "><span></span><strong><?= $fetch_product['price']; ?><span>.00 Dhs</span></strong></div>
                  <input type="number" name="qty" style="  text-align: center; border-color: white;" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
               </div>
               <input type="button" onclick="to_cart('form-<?= $fetch_product['id']; ?>')" value="Add to cart" class="btn btn-add-cart" name="add_to_cart">
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>

   </div>
<br></br>
   <div class="wrap-top-banner" style="  ">
   <a href="#" class="link-banner banner-effect-2">
      <figure><img src="assets/images/digital-electronic-banner.jpg" width="1170" height="240" alt=""></figure>
   </a>
</div>
</section>



<br></br>

<?php include 'components/footer.php'; ?>



<script>
   

   var swiper = new Swiper(".home-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
   });

   var swiper1 = new Swiper(".category-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
      breakpoints: {
         0: {
            slidesPerView: 2,
         },
         650: {
            slidesPerView: 3,
         },
         768: {
            slidesPerView: 4,
         },
         1024: {
            slidesPerView: 5,
         },
      },
   });

   var swiper2 = new Swiper(".products-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
      breakpoints: {
         550: {
            slidesPerView: 2,
         },
         768: {
            slidesPerView: 2,
         },
         1024: {
            slidesPerView: 3,
         },
      },
   });
</script>

</body>

</html>